const gulp = require('gulp');

const requireDir = require('require-dir');
const tasks = requireDir('./tasks');

exports.hello = tasks.hello;