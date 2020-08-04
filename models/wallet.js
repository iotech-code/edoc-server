'use strict';
module.exports = (sequelize, DataTypes) => {
  const Wallet = sequelize.define('Wallet', {
    user_id: DataTypes.INTEGER,
    point: DataTypes.DECIMAL
  }, {
    underscored: true,
  });
  Wallet.associate = function(models) {
    // associations can be defined here
  };
  return Wallet;
};