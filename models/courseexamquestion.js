'use strict';
module.exports = (sequelize, DataTypes) => {
  const CourseExamQuestion = sequelize.define('CourseExamQuestion', {
    exam_id: DataTypes.INTEGER,
    question_type_id: DataTypes.INTEGER,
    question: DataTypes.STRING,
    anwser_id: DataTypes.INTEGER,
    anwser_text: DataTypes.TEXT,
    max_point: DataTypes.INTEGER
  }, {
    underscored: true,
  });
  CourseExamQuestion.associate = function(models) {
    // associations can be defined here
  };
  return CourseExamQuestion;
};