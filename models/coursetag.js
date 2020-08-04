'use strict';
module.exports = (sequelize, DataTypes) => {
  const CourseTag = sequelize.define('CourseTag', {
    course_id: DataTypes.INTEGER,
    tag_id: DataTypes.INTEGER
  }, {
    underscored: true,
  });
  CourseTag.associate = function(models) {
    // associations can be defined here
  };
  return CourseTag;
};