'use strict';
module.exports = (sequelize, DataTypes) => {
  const ApiToken = sequelize.define('ApiToken', {
    user_id: DataTypes.INTEGER,
    token: DataTypes.STRING
  }, {
    underscored: true,
  });
  ApiToken.associate = function(models) {
    // associations can be defined here
    ApiToken.belongsTo(models.User, {
      foreignKey: 'user_id',
      as: 'user'
    })
  };

  return ApiToken;
};