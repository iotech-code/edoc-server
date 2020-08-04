'use strict';
module.exports = (sequelize, DataTypes) => {
  const CourseExamChoice = sequelize.define('CourseExamChoice', {
    question_id: DataTypes.INTEGER,
    position: DataTypes.INTEGER,
    choice_text: DataTypes.STRING
  }, {
    underscored: true,
  });
  CourseExamChoice.associate = function(models) {
    // associations can be defined here
  };
  return CourseExamChoice;
};