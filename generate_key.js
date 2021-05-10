const crypto = require('crypto');

const randomBuf = crypto.randomBytes(32)
const key = randomBuf.toString('base64');

console.log(key)