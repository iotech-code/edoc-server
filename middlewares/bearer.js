var user = require('../models/user')
var models = require('../models')


exports.handle = (req, res, next) => {
    // token = 
    if ( req.headers.authorization && req.headers.authorization.match("Bearer"))
        token = req.headers.authorization.split(" ")[1];
    else 
        res.send(401)
    models.ApiToken.findOne({
        where:{
            token: token
        },
        include: {
            model: models.User,
            as: 'user'
        }
    }).then( api => {
        if (api) {
            res.locals.user = api.user;
            next();
        }
        else res.send(401)
    })
}
