'use strict';
module.exports = {
  up: (queryInterface, Sequelize) => {
    return queryInterface.createTable('CourseExamQuestions', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      exam_id: {
        type: Sequelize.INTEGER
      },
      question_type_id: {
        type: Sequelize.INTEGER
      },
      question: {
        type: Sequelize.STRING
      },
      anwser_id: {
        type: Sequelize.INTEGER
      },
      anwser_text: {
        type: Sequelize.TEXT
      },
      max_point: {
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
    return queryInterface.dropTable('CourseExamQuestions');
  }
};