'use strict';
module.exports = (sequelize, DataTypes) => {
  const ClassRoom = sequelize.define('ClassRoom', {
    grade_id: DataTypes.INTEGER,
    school_id: DataTypes.INTEGER,
    room_no: DataTypes.INTEGER
  }, {
    underscored: true,
  });
  ClassRoom.associate = function(models) {
    // associations can be defined here
  };
  return ClassRoom;
};