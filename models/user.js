var bcrypt = require('bcrypt')
'use strict';
module.exports = (sequelize, DataTypes) => {
  const User = sequelize.define('User', {
    role_id: DataTypes.INTEGER,
    email: DataTypes.STRING,
    password: DataTypes.STRING,
    image: DataTypes.STRING,
    first_name: DataTypes.STRING,
    last_name: DataTypes.STRING,
    birth_date: DataTypes.DATE,
    school_id: DataTypes.INTEGER,
    grade_id: DataTypes.INTEGER,
    phone: DataTypes.STRING
  }, {
    underscored: true,
    defaultScope: {
      attributes: { exclude: ['password'] },
    }
  });
  User.associate = function(models) {
    // associations can be defined here
    User.hasMany(models.ApiToken, {
      foreignKey: 'user_id',
      as: 'token'
    })
  };
  User.prototype.verifyPassword = function(text){
    result = bcrypt.compareSync(String(text), this.password);
    return result;
  };
  return User;
};