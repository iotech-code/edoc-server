var createError = require('http-errors');
var express = require('express');
var path = require('path');
var cookieParser = require('cookie-parser');
var logger = require('morgan');
var bodyParser = require('body-parser');
var multer = require('multer');
var uploadTmp = multer({ dest: 'tmp/'});

var bearerMiddleware = require('./middlewares/bearer').handle

var indexRouter = require('./routes/index');
var authRouter = require('./routes/api/auth');
var userRouter = require('./routes/api/users');
var courseRouter = require('./routes/api/course');

var app = express();

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'hbs');

app.use(bodyParser.json());
// app.use(upload.array()); 

app.use(logger('dev'));
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));


app.use('/api', indexRouter);
app.use('/api/auth', uploadTmp.single('image'), authRouter);
app.use('/api/users', bearerMiddleware, userRouter);
app.use('/api/courses', bearerMiddleware, userRouter);
app.use('/api/wishlist', bearerMiddleware, userRouter);

// catch 404 and forward to error handler
app.use(function(req, res, next) {
  next(createError(404));
});

// error handler
app.use(function(err, req, res, next) {
  // set locals, only providing error in development
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};

  // render the error page
  res.status(err.status || 500);
  res.render('error');
});

module.exports = app;
