
'use strict'
var models = require('../models');
var crypto = require('crypto');
var bcrypt = require('bcrypt')
var fs = require('fs');

var createToken = () => {
    return crypto.randomBytes(64).toString('hex');

}

exports.login = function(req, res, next) {
    models.User.findOne({
        where: {
            email: req.body.email
        },
        include: {
            model: models.ApiToken,
            as: 'token'
        }
    })
    .then( user => {
        // res.send(user.verifyPassword(req.body.password))
        // if (user!=null && user.verifyPassword(req.body.password) ){
        if (user!=null) {
            let token = createToken();
            user = user.toJSON();
            models.ApiToken.create({
                token: token,
                user_id: user.id
            });
            user.token = token;
            res.send(user)
        }
        else{
            res.send(401, {
                message: "เข้าสู่ระบบไม่สำเร็จ"
            }) 
        }
    });
}

exports.register = (req, res, next) => {
    // if( req.image ) {
    //     fs.rename(req.image.path, '')
    // }
    console.log(req);
    
    res.send(req);
    models.User.create({
        role_id: req.body.status_register,
        email: req.body.email,
        password: bcrypt.hashSync(req.body.password, 10),
        first_name: req.body.firstname,
        last_name: req.body.lastname,
        birth_date: req.body.birthname,
        school_id: req.body.school,
        grade_id: req.body.grade_id,
        phone: req.body.phone,
    })
    .then( user => {
        let re = user.toJSON() 
        res.send( re );
    })
    .catch( err => {
        res.send(400, err.errors)
    })
} 

exports.logout = (req, res, next) => {
} 