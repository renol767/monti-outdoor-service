import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import fg from 'fast-glob'

const inputs = fg.sync([
  'resources/css/**/*.css',
  'resources/js/**/*.js',
  ...fg.sync([
    'resources/assets/vendor/**/main.scss',
  ])
])

export default defineConfig({
  plugins: [
    laravel({
      input: inputs,
      refresh: true,
    }),
  ],
})