'use strict';
module.exports = (sequelize, DataTypes) => {
  const CourseContent = sequelize.define('CourseContent', {
    course_id: DataTypes.INTEGER,
    name: DataTypes.STRING,
    type: DataTypes.STRING,
    position: DataTypes.INTEGER
  }, {
    underscored: true,
  });
  CourseContent.associate = function(models) {
    // associations can be defined here
  };
  return CourseContent;
};