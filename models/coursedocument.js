'use strict';
module.exports = (sequelize, DataTypes) => {
  const CourseDocument = sequelize.define('CourseDocument', {
    content_id: DataTypes.INTEGER,
    url_path: DataTypes.STRING
  }, {
    underscored: true,
  });
  CourseDocument.associate = function(models) {
    // associations can be defined here
  };
  return CourseDocument;
};