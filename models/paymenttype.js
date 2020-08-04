'use strict';
module.exports = (sequelize, DataTypes) => {
  const PaymentType = sequelize.define('PaymentType', {
    name: DataTypes.STRING
  }, {
    underscored: true,
  });
  PaymentType.associate = function(models) {
    // associations can be defined here
  };
  return PaymentType;
};