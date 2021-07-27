from cryptography import x509
from cryptography.hazmat.primitives import serialization
from cryptography.x509.oid import NameOID
from cryptography.hazmat.primitives.asymmetric import ec
from cryptography.hazmat.primitives.hashes import SHA256
import datetime
import sys
import binascii
import json
import argparse

ONE_DAY = datetime.timedelta(1, 0, 0)


def keystore_to_pubkey(in_file: str) -> bytes:
    with open(in_file, "rb") as f:
        in_keystore = json.load(f)
    pub_key_json = in_keystore[1]["y"]
    pkey_x_str: bytes = binascii.unhexlify(pub_key_json["x"].zfill(64))
    pkey_y_str: bytes = binascii.unhexlify(pub_key_json["y"].zfill(64))

    # Uncomporessed mode
    return b"\x04" + pkey_x_str + pkey_y_str


def build_name(common_name: str) -> x509.Name:
    return x509.Name(
        [
            x509.NameAttribute(NameOID.COMMON_NAME, common_name),
        ]
    )


def generate_certificate_from_keystore(
    pkey_encoded: str,
    ca_name: str,
    subject_name: str,
    days_of_validity: int,
    ca_private_key_scalar: int,
) -> x509.Certificate:
    today = datetime.datetime.today()
    ca_priv_key = ec.derive_private_key(ca_private_key_scalar, ec.SECP256K1())

    public_key = ec.EllipticCurvePublicKey.from_encoded_point(
        ec.SECP256K1(), pkey_encoded
    )

    clinet_cert_builder = x509.CertificateBuilder(
        build_name(ca_name),
        build_name(subject_name),
        public_key,
        x509.random_serial_number(),
        today - ONE_DAY,
        today + ONE_DAY * days_of_validity,
        [],
    )

    return clinet_cert_builder.sign(ca_priv_key, SHA256())


def auto_int(x: str) -> int:
    return int(x, 0)


def main() -> None:
    parser = argparse.ArgumentParser(description="generate a certificate")
    parser.add_argument("--keystore-file", type=keystore_to_pubkey, required=True)
    parser.add_argument("--ca-name", required=True)
    parser.add_argument("--subject-name", required=True)
    parser.add_argument("--days-of-validity", type=int, required=True)
    parser.add_argument("--ca-private-key-scalar", type=auto_int, required=True)
    parser.add_argument("--out-file", required=True)

    args = parser.parse_args()

    pkey_encoded = args.keystore_file
    ca_name = args.ca_name
    subject_name = args.subject_name
    days_of_validity = args.days_of_validity
    ca_private_key_scalar = args.ca_private_key_scalar
    output_file_name = args.out_file

    certificate = generate_certificate_from_keystore(
        pkey_encoded, ca_name, subject_name, days_of_validity, ca_private_key_scalar
    )

    with open(output_file_name, "wb") as f:
        f.write(certificate.public_bytes(serialization.Encoding.PEM))


if __name__ == "__main__":
    main()
