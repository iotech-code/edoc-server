var fs = require('fs')
var path = require('path')
var filePath = require.main.filename;

var cmd = process.argv.slice(2);

var fileNameInput = cmd[0].replace(/.+=/g, "")

var rootPath = path.join(filePath,'../..');

var controllerFileName = fileNameInput+'-controller';
var routeFileName = fileNameInput;

var controllerPattern = `
'use strict'
var models = require('../models');
`

var routePattern = `
var express = require('express');
var router = express.Router();

var controller = require('../controllers/${controllerFileName}');

// code here

module.exports = router;
`
console.log(fileNameInput);


fs.writeFile(`${rootPath}/controllers/${controllerFileName}.js`, controllerPattern, function(e){
    if (e)
        console.log(e);
});

fs.writeFile(`${rootPath}/routes/${routeFileName}.js`, routePattern, function(e){
    if (e)
        console.log(e);
    
});