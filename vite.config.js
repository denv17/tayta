import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";
import basicSsl from "@vitejs/plugin-basic-ssl";
import path from "path";

export default defineConfig({
  plugins: [tailwindcss(), basicSsl()],
  server: {
    https: true,
    host: true,
    cors: true,
  },
  build: {
    outDir: "public",
    emptyOutDir: true,
    manifest: true, // Generate manifest for WordPress
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, "src/js/main.js"),
      },
      output: {
        entryFileNames: "app.js",
        assetFileNames: (assetInfo) => {
          if (assetInfo.name === "main.css") {
            return "bundle.css";
          }
          return "assets/[name].[ext]";
        },
      },
    },
  },
});
