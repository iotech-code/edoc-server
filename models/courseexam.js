'use strict';
module.exports = (sequelize, DataTypes) => {
  const CourseExam = sequelize.define('CourseExam', {
    course_id: DataTypes.INTEGER,
    content_id: DataTypes.STRING,
    is_random: DataTypes.BOOLEAN,
    type: DataTypes.STRING
  }, {
    underscored: true,
  });
  CourseExam.associate = function(models) {
    // associations can be defined here
  };
  return CourseExam;
};