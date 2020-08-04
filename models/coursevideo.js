'use strict';
module.exports = (sequelize, DataTypes) => {
  const CourseVideo = sequelize.define('CourseVideo', {
    content_id: DataTypes.INTEGER,
    url_path: DataTypes.STRING
  }, {
    underscored: true,
  });
  CourseVideo.associate = function(models) {
    // associations can be defined here
  };
  return CourseVideo;
};