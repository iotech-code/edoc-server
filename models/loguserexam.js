'use strict';
module.exports = (sequelize, DataTypes) => {
  const LogUserExam = sequelize.define('LogUserExam', {
    user_id: DataTypes.INTEGER,
    exam_id: DataTypes.INTEGER,
    status: DataTypes.INTEGER,
    total_point: DataTypes.INTEGER,
    question_total: DataTypes.INTEGER,
    checked_total: DataTypes.INTEGER
  }, {
    underscored: true,
  });
  LogUserExam.associate = function(models) {
    // associations can be defined here
  };
  return LogUserExam;
};