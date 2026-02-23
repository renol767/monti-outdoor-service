import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import fg from 'fast-glob'

const inputs = fg.sync([
  'resources/css/**/*.css',
  'resources/js/**/*.js',
])

export default defineConfig({
  plugins: [
    laravel({
      input: inputs,
      refresh: true,
    }),
  ],
})