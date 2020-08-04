'use strict';
module.exports = (sequelize, DataTypes) => {
  const UserClassRoom = sequelize.define('UserClassRoom', {
    user_id: DataTypes.INTEGER,
    school_id: DataTypes.INTEGER,
    role_id: DataTypes.INTEGER
  }, {
    underscored: true,
  });
  UserClassRoom.associate = function(models) {
    // associations can be defined here
  };
  return UserClassRoom;
};