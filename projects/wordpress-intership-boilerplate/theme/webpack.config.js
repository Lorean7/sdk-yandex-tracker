const path = require('path');
const webpack = require('webpack');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

const config = {
    entry: {
        index: './assets/src/index.js',
    },
    output: {
        path: path.resolve(__dirname, './assets/dist'),
        filename: '[name].min.js',
        publicPath: '/wp-content/themes/wib/assets/dist/',
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                },
            },
            {
                test: /\.css$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: [{
                        loader: 'css-loader',
                    }],
                }),
            },
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: [
                        {
                            loader: 'css-loader',
                        },
                        {
                            loader: 'group-css-media-queries-loader',
                        },
                        {
                            loader: 'sass-loader',
                        },
                    ],
                }),
            },
        ],
    },
    externals: {
        'jquery': 'jQuery',
    },
    plugins: [
        new ExtractTextPlugin({
            filename: '[name].min.css'
        }),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery'
        }),
    ]
}

module.exports = (env, argv) => {
    if(argv.mode === 'development') {
        config.plugins.push(new BundleAnalyzerPlugin())
    }

    return config;
};
