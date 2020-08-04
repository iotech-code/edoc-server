'use strict';
module.exports = (sequelize, DataTypes) => {
  const UserInteresting = sequelize.define('UserInteresting', {
    user_id: DataTypes.INTEGER,
    tag_id: DataTypes.INTEGER
  }, {
    underscored: true,
  });
  UserInteresting.associate = function(models) {
    // associations can be defined here
  };
  return UserInteresting;
};