#!/bin/bash
for dot in *; do
    name="${dot%%.*}";
    ext="${dot#*.}";
    if [[ $ext == "dot" ]]; then
        dot "${name}.dot" -Tsvg -o "../images/${name}.svg";
    fi
done
