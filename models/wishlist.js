'use strict';
module.exports = (sequelize, DataTypes) => {
  const Wishlist = sequelize.define('Wishlist', {
    user_id: DataTypes.INTEGER,
    course_id: DataTypes.INTEGER
  }, {
    underscored: true,
  });
  Wishlist.associate = function(models) {
    // associations can be defined here
  };
  return Wishlist;
};