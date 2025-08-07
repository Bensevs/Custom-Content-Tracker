const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');

module.exports = (env, argv) => {
    const isProduction = argv.mode === 'production';

    return {
        entry: './assets/src/js/ticker.js',
        output: {
            path: path.resolve(__dirname, 'assets/dist'),
            filename: 'js/ticker.min.js',
            clean: true,
        },
        plugins: [
            new MiniCssExtractPlugin({
                filename: 'css/ticker.min.css',
            }),
        ],
        module: {
            rules: [
                {
                    test: /\.scss$/,
                    use: [
                        MiniCssExtractPlugin.loader,
                        'css-loader',
                        'sass-loader',
                    ],
                },
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: ['@babel/preset-env'],
                        },
                    },
                },
            ],
        },
        optimization: {
            minimize: isProduction,
            minimizer: [
                `...`, // Extends existing minimizers (for JS)
                new CssMinimizerPlugin(), // Adds CSS minifier
            ],
        },
        devtool: isProduction ? false : 'source-map',
    };
};