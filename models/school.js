'use strict';
module.exports = (sequelize, DataTypes) => {
  const School = sequelize.define('School', {
    name: DataTypes.STRING
  }, {
    underscored: true,
  });
  School.associate = function(models) {
    // associations can be defined here
  };
  return School;
};