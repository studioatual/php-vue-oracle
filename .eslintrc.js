module.exports = {
  env: {
    browser: true,
    es6: true,
  },
  extends: ['plugin:vue/essential', 'airbnb-base', 'prettier'],
  globals: {
    Atomics: 'readonly',
    SharedArrayBuffer: 'readonly',
  },
  parserOptions: {
    ecmaVersion: 2018,
    sourceType: 'module',
  },
  plugins: ['vue', 'prettier'],
  rules: {
    'prettier/prettier': 'error',
    'import/extensions': ['ignorePackages'],
    'no-param-reassign': [
      'off',
      {
        props: true,
        ignorePropertyModificationsFor: ['state'],
      },
    ],
  },
  settings: {
    'import/resolver': 'webpack',
  },
};
