import { wayfinder } from '@laravel/vite-plugin-wayfinder'
import tailwindcss from '@tailwindcss/vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'
import IconsResolver from 'unplugin-icons/resolver'
import IconsPlugin from 'unplugin-icons/vite'
import Components from 'unplugin-vue-components/vite'
import { defineConfig } from 'vite'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/js/app.ts'],
      refresh: true,
    }),
    tailwindcss(),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
    wayfinder({
      formVariants: true,
      path: 'resources/js/wayfinder',
    }),
    Components({
      resolvers: [IconsResolver()],
      dts: 'resources/js/types/components.d.ts',
    }),
    IconsPlugin(),
  ],
})
