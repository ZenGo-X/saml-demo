FROM ubuntu:20.04
RUN apt update &&  \
    apt install  -y --no-install-recommends curl git netcat libgmp-dev build-essential bash ca-certificates xxd python3 python3-pip && \
    pip3 install cryptography
RUN curl --proto '=https' --tlsv1.2 -sSf https://sh.rustup.rs | sh -s -- -y --default-toolchain nightly-2021-05-30
RUN git clone -b 'v0.4.6' --single-branch --depth 1 https://github.com/ZenGo-X/multi-party-ecdsa.git /mpe
ENV PATH="/root/.cargo/bin:${PATH}"
RUN cargo build --release --examples --manifest-path /mpe/Cargo.toml
CMD /script/start

