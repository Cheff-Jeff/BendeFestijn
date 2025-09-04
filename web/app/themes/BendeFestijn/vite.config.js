import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { wordpressPlugin, wordpressThemeJson } from '@roots/vite-plugin';

export default defineConfig({
  base: '/app/themes/BendeFestijn/public/build/',
  plugins: [
    laravel({
      input: {
        appCss: 'resources/css/app.scss',
        appJs: 'resources/js/app.js',
        editorCss: 'resources/css/editor.scss',
        editorJs: 'resources/js/editor.js',
        pageBuilderCss: 'resources/css/page-builder.scss',
        pageBuilderJs: 'resources/js/page-builder.js',
        footerBuilderCss: 'resources/css/footer-builder.scss',
        footerBuilderJs: 'resources/js/footer-builder.js',
        loginCss: 'resources/css/login-admin.scss',
      },
      refresh: true,
    }),

    wordpressPlugin(),

    // Generate the theme.json file in the public/build/assets directory
    // based on the Tailwind config and the theme.json file from base theme folder
    wordpressThemeJson({
      disableTailwindColors: true,
      disableTailwindFonts: true,
      disableTailwindFontSizes: true,
    }),
  ],
  resolve: {
    alias: {
      '@scripts': '/resources/js',
      '@styles': '/resources/css',
      '@fonts': '/resources/fonts',
      '@images': '/resources/images',
    },
  },
  build: {
    rollupOptions: {
      output: {
        format: 'es',
        entryFileNames: ({ name }) => {
          return name === 'appCss' || name === 'editorCss'
            ? `assets/[name].css`
            : `assets/scripts/[name].js`;
        },
        assetFileNames: (assetInfo) => {
          return 'assets/styles/' + assetInfo.name;
        },
      },
    },
  },
});
