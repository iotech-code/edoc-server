'use strict';
module.exports = (sequelize, DataTypes) => {
  const Address = sequelize.define('Address', {
    user_id: DataTypes.INTEGER,
    address_1: DataTypes.STRING,
    address_2: DataTypes.STRING,
    city: DataTypes.STRING,
    state: DataTypes.STRING,
    country: DataTypes.STRING,
    postal_code: DataTypes.STRING
  }, {
    underscored: true,
  });
  Address.associate = function(models) {
    // associations can be defined here
  };
  return Address;
};