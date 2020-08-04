
var express = require('express');
var router = express.Router();

var controller = require('../../controllers/auth-controller');

// code here
router.post('/login', controller.login);
router.post('/register', controller.register);
module.exports = router;
