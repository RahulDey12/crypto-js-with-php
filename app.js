const CryptoJS = require("crypto-js");
const crypto = require('crypto')

const password = '1234';
const iv = crypto.randomBytes(16).toString();

const encrypted = CryptoJS.AES.encrypt("Hello", password, {iv})
const payload = {
    ct: encrypted.ciphertext.toString(CryptoJS.enc.Base64),
    iv: encrypted.iv.toString(),
    s: encrypted.salt.toString()
}

console.log(new Buffer.from(JSON.stringify(payload), 'utf-8').toString('base64'))