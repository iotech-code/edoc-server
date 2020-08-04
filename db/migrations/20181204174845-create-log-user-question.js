'use strict';
module.exports = {
  up: (queryInterface, Sequelize) => {
    return queryInterface.createTable('LogUserQuestions', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      user_id: {
        type: Sequelize.INTEGER
      },
      exam_id: {
        type: Sequelize.INTEGER
      },
      question_id: {
        type: Sequelize.INTEGER
      },
      answer_text: {
        type: Sequelize.STRING
      },
      answer_id: {
        type: Sequelize.INTEGER
      },
      point: {
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
    return queryInterface.dropTable('LogUserQuestions');
  }
};