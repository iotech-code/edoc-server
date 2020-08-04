'use strict';

var models = require('../models');

exports.home = function(req, res, next){
    res.send(res.locals.user);
}

exports.getById = (req, res, next) => {

    result = models.user.findById(req.params.userId).then( function(user){
        return user;
    })
    res.send(req.params.userId);
}
