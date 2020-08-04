'use strict';
module.exports = {
  up: (queryInterface, Sequelize) => {
    return queryInterface.createTable('WalletTransactions', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      wallet_id: {
        type: Sequelize.INTEGER
      },
      before_value: {
        type: Sequelize.DECIMAL
      },
      after_value: {
        type: Sequelize.DECIMAL
      },
      action_id: {
        type: Sequelize.INTEGER
      },
      refer_id: {
        type: Sequelize.INTEGER
      },
      created_at: {
        allowNull: false,
        type: Sequelize.DATE
      },
      updated_at: {
        allowNull: false,
        type: Sequelize.DATE
      }
    });
  },
  down: (queryInterface, Sequelize) => {
    return queryInterface.dropTable('WalletTransactions');
  }
};