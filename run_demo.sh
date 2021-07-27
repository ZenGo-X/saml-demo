#!/usr/bin/env bash
if [ -z "$TMUX" ]; then echo "Please run the demo from within a TMUX session..."; echo "You can simply run 'tmux' to start a new tmux session."; exit; fi
export PARTIES=3
mkdir -p simplesamlphp/cert
docker compose up -d
if [ -n "$(which tmux)" ]; then
	tmux splitw -h docker compose logs server.signer --follow
	tmux splitw -v -l 33% docker compose logs 2_client.signer --follow
	tmux last-pane
	tmux splitw -v -l 50% docker compose logs 1_client.signer --follow
fi
	clear

if [ -n "$(which openssl)" ]; then
	echo "IDP Certificate:"
	openssl x509 -in simplesamlphp/cert/idp.zengo.saml.crt -text
fi

echo "Setup finished - please browse to https://sp.zengo.saml"
