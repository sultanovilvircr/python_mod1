<?php
namespace certman;

use consonance\proto\wa20_pb20;
use vendor\logging;
use vendor\axolotl_curve25519 as curve;

$logger = logging::getLogger($__name__);
class CertMan extends stdClass {
    function __construct() {
        $this->_pubkeys = ['WhatsAppLongTerm1' => bytearray([20, 35, 117, 87, 77, 10, 88, 113, 102, 170, 231, 30, 190, 81, 100, 55, 196, 162, 139, 115, 227, 105, 92, 108, 225, 247, 249, 84, 93, 168, 238, 107])];
    }
    /**
     * :param rs:
     * :type rs: PublicKey
     * :param certificate_data:
     * :type certificate_data: bytes
     * :return:
     * :rtype:
     */
    function is_valid($rs,$certificate_data) {
        $cert = wa20_pb2::NoiseCertificate();
        $cert->ParseFromString($certificate_data);
        $cert_details = wa20_pb2::NoiseCertificate::Details();
        $cert_details->ParseFromString($cert->details);
        $logger->debug(sprintf('NoiseCertificate(signature=[%d bytes], serial=%d, issuer=\'%s\', expires=%d, subject=\'%s\', key=[%d bytes])', count($cert->signature), $cert_details->serial, $cert_details->issuer, $cert_details->expires, $cert_details->subject, count($cert_details->key)));
        if (!in_array($cert_details->issuer, $this->_pubkeys)) {
            $logger->error(sprintf('noise certificate issued by unknown source: issuer=%s', $cert_details->issuer));
            return false;
        }
        if ((curve::verifySignature($bytes($this->_pubkeys[$cert_details->issuer]), $cert->details, $cert->signature) != 0)) {
            $logger->error(sprintf('invalid signature on noise ceritificate; issuer=%s', $cert_details->issuer));
            return false;
        }
        if (($cert_details->key != $rs->data)) {
            $logger->error(sprintf('noise certificate key does not match proposed server static key; issuer=%s', $cert_details->issuer));
            return false;
        }
        if ($cert_details->HasField('expires') && ($cert_details->expires < intval(time()))) {
            $logger->error(sprintf('noise certificate expired; issuer=%s', $cert_details->issuer));
            return false;
        }
        return true;
    }
}

