#!/bin/bash
type="png";
for dot in *; do
    name="${dot%%.*}";
    ext="${dot#*.}";
    if [[ $ext == "dot" ]]; then
        dot "${name}.dot" -T${type} -o "../images/${name}.${type}";
    fi
done
