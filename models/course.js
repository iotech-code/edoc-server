'use strict';
module.exports = (sequelize, DataTypes) => {
  const Course = sequelize.define('Course', {
    name: DataTypes.STRING,
    price: DataTypes.DECIMAL,
    description: DataTypes.STRING,
    category_id: DataTypes.INTEGER,
    creator_id: DataTypes.INTEGER,
    study_grade_id: DataTypes.INTEGER,
    is_sugguestion: DataTypes.BOOLEAN,
    like_total: DataTypes.INTEGER
  }, {
    underscored: true,
  });
  Course.associate = function(models) {
    // associations can be defined here
  };
  return Course;
};