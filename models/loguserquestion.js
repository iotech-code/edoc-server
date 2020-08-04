'use strict';
module.exports = (sequelize, DataTypes) => {
  const LogUserQuestion = sequelize.define('LogUserQuestion', {
    user_id: DataTypes.INTEGER,
    exam_id: DataTypes.INTEGER,
    question_id: DataTypes.INTEGER,
    answer_text: DataTypes.STRING,
    answer_id: DataTypes.INTEGER,
    point: DataTypes.INTEGER
  }, {
    underscored: true,
  });
  LogUserQuestion.associate = function(models) {
    // associations can be defined here
  };
  return LogUserQuestion;
};