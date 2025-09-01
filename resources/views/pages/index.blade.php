
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.blackrockinvestmentcorporation.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Aug 2025 18:10:48 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="QHTgDfeSDEhGixs61ktyfaAnqYfyNU0Xv8qcvRbs">
    <meta name="locale" content="en">
    <meta name="content-language" content="en">
    <title>BlackRock | Home</title>
    <link rel="icon" href="storage/settings/l21Oj4xbtOpQp7BGToYlVcaPz1vISLAqr1vb5bwB.png" type="image/png" />
    <script src="https://cdn.tailwindcss.com/"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/pako@2.1.0/dist/pako.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>

    <style>
    #site-loader {
    transition: opacity 0.5s ease-in-out;
}

@keyframes pulse {
    0% { opacity: 0.6; transform: scale(0.98); }
    50% { opacity: 1; transform: scale(1); }
    100% { opacity: 0.6; transform: scale(0.98); }
}

.animate-pulse {
    animation: pulse 2s infinite;
}

    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap');

        :root {
            --primary-bg: #0A0714;
            --secondary-bg: #0D091C;
            --card-bg: #1A1428;
            --accent-color: #2FE6DE;
            --accent-hover: rgba(47, 230, 222, 0.8);
            --accent-light: rgba(47, 230, 222, 0.1);
            --text-primary: #FFFFFF;
            --text-secondary: #A0AEC0;
            --border-color: rgba(47, 230, 222, 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-primary);
        }

        /* Custom Scrollbar Styling */
        * {
            scrollbar-width: thin;
            scrollbar-color: rgba(47, 230, 222, 0.2) #1A1428;
        }

        *::-webkit-scrollbar {
            width: 8px;
        }

        *::-webkit-scrollbar-track {
            background: #1A1428;
            border-radius: 10px;
        }

        *::-webkit-scrollbar-thumb {
            background-color: rgba(47, 230, 222, 0.2);
            border-radius: 10px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        *::-webkit-scrollbar-thumb:hover {
            background-color: rgba(47, 230, 222, 0.4);
        }

        /* Animations */
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .animate-bounce-slow {
            animation: bounce 2s ease-in-out infinite;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-ping-slow {
            animation: ping 2s ease-in-out infinite;
        }
        
        @keyframes ping {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }

        /* Navbar styles */
        .navbar-item {
            position: relative;
        }

        .navbar-item::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--accent-color);
            transition: width 0.3s ease;
        }

        .navbar-item:hover::after,
        .navbar-item.active::after {
            width: 100%;
        }

        /* Card styles */
        .card {
            background-color: var(--card-bg);
            border-radius: 0.75rem;
            border: 1px solid var(--border-color);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Button styles */
        .btn-primary {
            background-color: var(--accent-color);
            color: var(--primary-bg);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--text-primary);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
        }

        /* Mobile navigation */
        .mobile-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--secondary-bg);
            z-index: 50;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-nav.active {
            transform: translateX(0);
        }

        /* Market ticker */
        .market-ticker {
            overflow: hidden;
            white-space: nowrap;
            position: relative;
        }

        .ticker-content {
            display: inline-block;
            animation: ticker 30s linear infinite;
        }

        @keyframes ticker {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        /* Dropdown styles */
        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--secondary-bg);
            min-width: 200px;
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
            z-index: 10;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Live Activity Notification Styles */
        .live-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(135deg, #1A1428 0%, #0D091C 100%);
            border: 1px solid rgba(47, 230, 222, 0.2);
            color: #FFFFFF;
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3), 0 0 20px rgba(47, 230, 222, 0.1);
            z-index: 9999;
            max-width: 380px;
            min-width: 320px;
            font-family: 'Inter', sans-serif;
            animation: slideInUp 0.5s ease-out;
            backdrop-filter: blur(10px);
        }

        .live-notification.investment {
            border-left: 4px solid #2FE6DE;
            background: linear-gradient(135deg, #1A1428 0%, rgba(47, 230, 222, 0.05) 100%);
        }

        .live-notification.withdrawal {
            border-left: 4px solid #F59E0B;
            background: linear-gradient(135deg, #1A1428 0%, rgba(245, 158, 11, 0.05) 100%);
        }

        .live-notification.deposit {
            border-left: 4px solid #10B981;
            background: linear-gradient(135deg, #1A1428 0%, rgba(16, 185, 129, 0.05) 100%);
        }

        .notification-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .notification-icon.investment {
            background: rgba(47, 230, 222, 0.1);
            color: #2FE6DE;
        }

        .notification-icon.withdrawal {
            background: rgba(245, 158, 11, 0.1);
            color: #F59E0B;
        }

        .notification-icon.deposit {
            background: rgba(16, 185, 129, 0.1);
            color: #10B981;
        }

        .notification-text {
            flex: 1;
        }

        .notification-message {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 4px;
            color: #FFFFFF;
        }

        .notification-details {
            font-size: 12px;
            color: #A0AEC0;
            margin-bottom: 2px;
        }

        .notification-time {
            font-size: 11px;
            color: #6B7280;
        }

        .notification-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s;
            font-size: 12px;
            color: #A0AEC0;
            flex-shrink: 0;
        }

        .notification-close:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #FFFFFF;
        }

        @keyframes slideInUp {
            0% {
                transform: translateY(100%);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideOutDown {
            0% {
                transform: translateY(0);
                opacity: 1;
            }
            100% {
                transform: translateY(100%);
                opacity: 0;
            }
        }

        .notification-hide {
            animation: slideOutDown 0.3s ease-in forwards;
        }

        /* Mobile responsive */
        @media (max-width: 640px) {
            .live-notification {
                bottom: 10px;
                right: 10px;
                left: 10px;
                max-width: none;
                min-width: auto;
            }
        }
    </style>
        <!-- Livewire Styles --><style >[wire\:loading][wire\:loading], [wire\:loading\.delay][wire\:loading\.delay], [wire\:loading\.inline-block][wire\:loading\.inline-block], [wire\:loading\.inline][wire\:loading\.inline], [wire\:loading\.block][wire\:loading\.block], [wire\:loading\.flex][wire\:loading\.flex], [wire\:loading\.table][wire\:loading\.table], [wire\:loading\.grid][wire\:loading\.grid], [wire\:loading\.inline-flex][wire\:loading\.inline-flex] {display: none;}[wire\:loading\.delay\.none][wire\:loading\.delay\.none], [wire\:loading\.delay\.shortest][wire\:loading\.delay\.shortest], [wire\:loading\.delay\.shorter][wire\:loading\.delay\.shorter], [wire\:loading\.delay\.short][wire\:loading\.delay\.short], [wire\:loading\.delay\.default][wire\:loading\.delay\.default], [wire\:loading\.delay\.long][wire\:loading\.delay\.long], [wire\:loading\.delay\.longer][wire\:loading\.delay\.longer], [wire\:loading\.delay\.longest][wire\:loading\.delay\.longest] {display: none;}[wire\:offline][wire\:offline] {display: none;}[wire\:dirty]:not(textarea):not(input):not(select) {display: none;}:root {--livewire-progress-bar-color: #ffffff;}[x-cloak] {display: none !important;}</style>
</head>

<body>
<!-- Add this loader HTML right after the body tag -->
<div id="site-loader" class="fixed inset-0 flex items-center justify-center bg-[#0A0714] z-50">
    <div class="flex flex-col items-center">
        <div class="w-32 h-32 mb-4">
            <img src="storage/settings/bv05CPQdQQcgRWpEAg1CMcA5t2CUohmbPg0XJXUD.png" alt="Loading..." class="animate-pulse w-full h-full object-contain">
        </div>
        
    </div>
</div>

    <!-- Advanced Stock Market Ticker -->
<div class="bg-gradient-to-r from-[#0A0714] via-[#0D091C] to-[#0A0714] py-3 overflow-hidden border-b border-[#2FE6DE]/20 shadow-lg">
    <div class="ticker-wrap">
        <div class="ticker" id="stock-ticker">
            <div class="ticker-item flex items-center">
                <span class="loading-ticker text-[#2FE6DE] animate-pulse">
                    <i class="fas fa-chart-line mr-2"></i>Loading market data...
                </span>
            </div>
        </div>
    </div>
    
    <!-- Market Status Bar -->
    <div class="flex justify-center items-center mt-1">
        <div class="flex items-center space-x-6 text-xs">
            <div class="flex items-center space-x-1">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-gray-400" id="market-status">Market Open</span>
            </div>
            <div class="text-gray-400" id="market-time"></div>
            <div class="flex items-center space-x-1">
                <i class="fas fa-arrow-up text-green-400"></i>
                <span class="text-green-400" id="gainers-count">0</span>
                <span class="text-gray-500">gainers</span>
            </div>
            <div class="flex items-center space-x-1">
                <i class="fas fa-arrow-down text-red-400"></i>
                <span class="text-red-400" id="losers-count">0</span>
                <span class="text-gray-500">losers</span>
            </div>
        </div>
    </div>
</div>

<script>
// Advanced Stock Market Ticker
class StockTicker {
    constructor() {
        this.stocks = [
            {
                symbol: 'AAPL',
                name: 'Apple Inc.',
                price: 175.43,
                change: 2.67,
                changePercent: 1.55,
                volume: 65432100,
                sector: 'Technology',
                exchange: 'NASDAQ'
            },
            {
                symbol: 'MSFT',
                name: 'Microsoft Corp',
                price: 384.30,
                change: -1.15,
                changePercent: -0.30,
                volume: 32156789,
                sector: 'Technology',
                exchange: 'NASDAQ'
            },
            {
                symbol: 'GOOGL',
                name: 'Alphabet Inc',
                price: 142.65,
                change: 1.25,
                changePercent: 0.88,
                volume: 28765432,
                sector: 'Communication',
                exchange: 'NASDAQ'
            },
            {
                symbol: 'TSLA',
                name: 'Tesla Inc',
                price: 248.48,
                change: 5.73,
                changePercent: 2.36,
                volume: 89543210,
                sector: 'Consumer Cyclical',
                exchange: 'NASDAQ'
            },
            {
                symbol: 'AMZN',
                name: 'Amazon.com',
                price: 156.77,
                change: -0.85,
                changePercent: -0.54,
                volume: 45321098,
                sector: 'Consumer Cyclical',
                exchange: 'NASDAQ'
            },
            {
                symbol: 'NVDA',
                name: 'NVIDIA Corp',
                price: 875.15,
                change: 18.90,
                changePercent: 2.21,
                volume: 76543210,
                sector: 'Technology',
                exchange: 'NASDAQ'
            },
            {
                symbol: 'META',
                name: 'Meta Platforms',
                price: 498.37,
                change: 7.23,
                changePercent: 1.47,
                volume: 23456789,
                sector: 'Communication',
                exchange: 'NASDAQ'
            },
            {
                symbol: 'BRK.B',
                name: 'Berkshire Hathaway',
                price: 432.15,
                change: 2.45,
                changePercent: 0.57,
                volume: 4567890,
                sector: 'Financial',
                exchange: 'NYSE'
            },
            {
                symbol: 'JPM',
                name: 'JPMorgan Chase',
                price: 168.45,
                change: -0.75,
                changePercent: -0.44,
                volume: 12345678,
                sector: 'Financial',
                exchange: 'NYSE'
            },
            {
                symbol: 'JNJ',
                name: 'Johnson & Johnson',
                price: 162.80,
                change: 1.10,
                changePercent: 0.68,
                volume: 8765432,
                sector: 'Healthcare',
                exchange: 'NYSE'
            },
            {
                symbol: 'V',
                name: 'Visa Inc',
                price: 267.90,
                change: 3.15,
                changePercent: 1.19,
                volume: 6543210,
                sector: 'Financial',
                exchange: 'NYSE'
            },
            {
                symbol: 'PG',
                name: 'Procter & Gamble',
                price: 155.22,
                change: -0.33,
                changePercent: -0.21,
                volume: 5432109,
                sector: 'Consumer Defensive',
                exchange: 'NYSE'
            },
            {
                symbol: 'UNH',
                name: 'UnitedHealth Group',
                price: 542.88,
                change: 4.67,
                changePercent: 0.87,
                volume: 3456789,
                sector: 'Healthcare',
                exchange: 'NYSE'
            },
            {
                symbol: 'HD',
                name: 'Home Depot',
                price: 385.44,
                change: -2.11,
                changePercent: -0.54,
                volume: 4321098,
                sector: 'Consumer Cyclical',
                exchange: 'NYSE'
            },
            {
                symbol: 'MA',
                name: 'Mastercard Inc',
                price: 456.78,
                change: 5.23,
                changePercent: 1.16,
                volume: 2345678,
                sector: 'Financial',
                exchange: 'NYSE'
            }
        ];
        
        this.init();
    }
    
    init() {
        this.updateTicker();
        this.updateMarketStatus();
        this.simulateRealTimeUpdates();
        
        // Update ticker every 30 seconds
        setInterval(() => {
            this.updateTicker();
        }, 30000);
        
        // Update market status every minute
        setInterval(() => {
            this.updateMarketStatus();
        }, 60000);
    }
    
    simulateRealTimeUpdates() {
        // Update prices every 3 seconds to simulate real-time trading
        setInterval(() => {
            this.stocks = this.stocks.map(stock => {
                const volatility = Math.random() * 0.02; // 0-2% volatility
                const direction = Math.random() > 0.5 ? 1 : -1;
                const priceChange = stock.price * volatility * direction * 0.1; // Smaller changes
                
                const newPrice = Math.max(0.01, stock.price + priceChange);
                const change = newPrice - stock.price;
                const changePercent = (change / stock.price) * 100;
                
                return {
                    ...stock,
                    price: newPrice,
                    change: change,
                    changePercent: changePercent,
                    volume: stock.volume + Math.floor(Math.random() * 100000)
                };
            });
            
            this.updateTicker();
        }, 3000);
    }
    
    updateTicker() {
        const tickerContainer = document.getElementById('stock-ticker');
        if (!tickerContainer) return;
        
        let tickerHTML = '';
        
        this.stocks.forEach(stock => {
            const isPositive = stock.changePercent >= 0;
            const changeClass = isPositive ? 'text-green-400' : 'text-red-400';
            const changeBgClass = isPositive ? 'bg-green-500/10' : 'bg-red-500/10';
            const changeIcon = isPositive ? 'fa-caret-up' : 'fa-caret-down';
            const borderClass = isPositive ? 'border-green-500/20' : 'border-red-500/20';
            
            tickerHTML += `
                <div class="ticker-item flex items-center mr-8 bg-[#1A1428]/50 rounded-lg px-3 py-2 border ${borderClass} hover:bg-[#1A1428] transition-all group">
                    <div class="flex items-center space-x-3">
                        <!-- Stock Symbol with Exchange -->
                        <div class="flex flex-col items-center">
                            <div class="font-bold text-white text-sm group-hover:text-[#2FE6DE] transition-colors">${stock.symbol}</div>
                            <div class="text-xs text-gray-500">${stock.exchange}</div>
                        </div>
                        
                        <!-- Divider -->
                        <div class="w-px h-8 bg-[#2FE6DE]/20"></div>
                        
                        <!-- Price -->
                        <div class="text-right">
                            <div class="font-mono font-semibold text-white text-sm">
                                ${this.formatCurrency(stock.price)}
                            </div>
                        </div>
                        
                        <!-- Change -->
                        <div class="flex items-center space-x-1 ${changeBgClass} px-2 py-1 rounded-md">
                            <i class="fas ${changeIcon} ${changeClass} text-xs"></i>
                            <span class="${changeClass} font-mono text-xs font-medium">
                                ${this.formatChange(stock.change)}
                            </span>
                            <span class="${changeClass} font-mono text-xs">
                                (${this.formatPercentage(stock.changePercent)})
                            </span>
                        </div>
                        
                        <!-- Volume (abbreviated) -->
                        <div class="text-xs text-gray-400 min-w-0">
                            <div class="truncate">Vol: ${this.formatVolume(stock.volume)}</div>
                        </div>
                        
                        <!-- Sector Tag -->
                        <div class="hidden lg:block">
                            <span class="px-2 py-1 bg-[#2FE6DE]/10 text-[#2FE6DE] rounded-full text-xs font-medium">
                                ${stock.sector}
                            </span>
                        </div>
                    </div>
                </div>
            `;
        });
        
        tickerContainer.innerHTML = tickerHTML;
        this.updateStats();
    }
    
    updateStats() {
        const gainers = this.stocks.filter(stock => stock.changePercent > 0).length;
        const losers = this.stocks.filter(stock => stock.changePercent < 0).length;
        
        const gainersElement = document.getElementById('gainers-count');
        const losersElement = document.getElementById('losers-count');
        
        if (gainersElement) gainersElement.textContent = gainers;
        if (losersElement) losersElement.textContent = losers;
    }
    
    updateMarketStatus() {
        const now = new Date();
        const marketOpen = new Date();
        marketOpen.setHours(9, 30, 0, 0); // 9:30 AM EST
        const marketClose = new Date();
        marketClose.setHours(16, 0, 0, 0); // 4:00 PM EST
        
        const isWeekday = now.getDay() >= 1 && now.getDay() <= 5;
        const isMarketHours = now >= marketOpen && now <= marketClose;
        const isOpen = isWeekday && isMarketHours;
        
        const statusElement = document.getElementById('market-status');
        const timeElement = document.getElementById('market-time');
        
        if (statusElement) {
            statusElement.textContent = isOpen ? 'Market Open' : 'Market Closed';
            statusElement.className = isOpen ? 'text-green-400' : 'text-red-400';
        }
        
        if (timeElement) {
            const timeOptions = {
                timeZone: 'America/New_York',
                hour12: true,
                hour: 'numeric',
                minute: '2-digit',
                timeZoneName: 'short'
            };
            timeElement.textContent = now.toLocaleTimeString('en-US', timeOptions);
        }
    }
    
    formatCurrency(value) {
        return '$' + value.toLocaleString('en-US', { 
            minimumFractionDigits: 2, 
            maximumFractionDigits: 2 
        });
    }
    
    formatChange(value) {
        const sign = value >= 0 ? '+' : '';
        return `${sign}${value.toFixed(2)}`;
    }
    
    formatPercentage(value) {
        const sign = value >= 0 ? '+' : '';
        return `${sign}${value.toFixed(2)}%`;
    }
    
    formatVolume(value) {
        if (value >= 1e9) {
            return (value / 1e9).toFixed(1) + 'B';
        } else if (value >= 1e6) {
            return (value / 1e6).toFixed(1) + 'M';
        } else if (value >= 1e3) {
            return (value / 1e3).toFixed(1) + 'K';
        } else {
            return value.toLocaleString();
        }
    }
}

// Initialize the stock ticker when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new StockTicker();
});

// Remove the old crypto functions and replace with stock ticker
function fetchCryptoData() {
    // This function is now handled by StockTicker class
    // Keeping empty to avoid errors if called elsewhere
}

function updateTicker(data) {
    // This function is now handled by StockTicker class
    // Keeping empty to avoid errors if called elsewhere
}
</script>

<style>
/* Advanced Ticker Styles */
.ticker-wrap {
    width: 100%;
    overflow: hidden;
    height: 60px;
    padding: 0;
    box-sizing: border-box;
    position: relative;
}

.ticker {
    display: flex;
    white-space: nowrap;
    padding-right: 100%;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
    animation-name: stockTicker;
    animation-duration: 45s; /* Slightly slower for better readability */
}

.ticker-item {
    display: inline-flex;
    align-items: center;
    padding: 0 0.5rem;
    flex-shrink: 0;
}

@keyframes stockTicker {
    0% {
        transform: translate3d(0, 0, 0);
    }
    100% {
        transform: translate3d(-100%, 0, 0);
    }
}

/* Hover effects for ticker items */
.ticker-item:hover {
    transform: scale(1.02);
    z-index: 10;
    position: relative;
}

/* Enhanced animations */
.ticker-item .group-hover\:text-\[\#2FE6DE\]:hover {
    text-shadow: 0 0 8px rgba(47, 230, 222, 0.5);
}

/* Loading animation */
.loading-ticker {
    background: linear-gradient(-45deg, #2FE6DE, #1A1428, #2FE6DE, #1A1428);
    background-size: 400% 400%;
    animation: loadingGradient 2s ease infinite;
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

@keyframes loadingGradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .ticker-item {
        padding: 0 0.25rem;
    }
    
    .ticker-wrap {
        height: 50px;
    }
    
    .ticker {
        animation-duration: 35s; /* Faster on mobile */
    }
}

/* Market status indicators */
#market-status {
    transition: color 0.3s ease;
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .7;
    }
}

/* Smooth transitions for real-time updates */
.ticker-item * {
    transition: all 0.2s ease;
}
</style>
    <!-- Main Header -->
    <header class="bg-[#0D091C] border-b border-[#2FE6DE]/10 shadow-lg sticky top-0 z-40">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="index.html" class="flex items-center">
                        <img src="storage/settings/bv05CPQdQQcgRWpEAg1CMcA5t2CUohmbPg0XJXUD.png" alt="Logo" class="h-8">
                    </a>
                    <nav class="hidden lg:flex ml-10 space-x-6">
                        <a href="index.html" class="navbar-item text-white hover:text-[#2FE6DE] transition-colors py-2 active">Home</a>
                        <a href="markets.html" class="navbar-item text-white hover:text-[#2FE6DE] transition-colors py-2 flex items-center ">
                                Markets
                            </a>
                        <div class="dropdown">
                            <a href="#" class="navbar-item text-white hover:text-[#2FE6DE] transition-colors py-2 flex items-center">
                                Trade
                                <i class="fas fa-chevron-down text-xs ml-1"></i>
                            </a>
                            <div class="dropdown-content py-2">
                                <a href="login.html" class="block px-4 py-2 hover:bg-[#1A1428] text-white hover:text-[#2FE6DE]">Spot</a>
                                <a href="login.html" class="block px-4 py-2 hover:bg-[#1A1428] text-white hover:text-[#2FE6DE]">Margin</a>
                                <a href="login.html" class="block px-4 py-2 hover:bg-[#1A1428] text-white hover:text-[#2FE6DE]">Bot Trading</a>
                                <a href="login.html" class="block px-4 py-2 hover:bg-[#1A1428] text-white hover:text-[#2FE6DE]">Copy Trading</a>
                            </div>
                        </div>
                        <a href="about.html" class="navbar-item text-white hover:text-[#2FE6DE] transition-colors py-2 ">About</a>
                        <a href="contact.html" class="navbar-item text-white hover:text-[#2FE6DE] transition-colors py-2 ">Contact</a>
                    </nav>
                </div>
                
                <div class="hidden lg:flex items-center space-x-4">
                                            <a href="login.html" class="btn-secondary">Login</a>
                        <a href="register.html" class="btn-primary">Sign Up</a>
                                    </div>
                
                <!-- Mobile menu button -->
                <div class="lg:hidden flex items-center">
                                        <button id="mobileMenuBtn" class="text-white focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Mobile menu -->
    <div id="mobileMenu" class="mobile-nav lg:hidden">
        <div class="flex justify-between items-center p-4 border-b border-[#2FE6DE]/10">
            <a href="index.html">
                <img src="storage/settings/bv05CPQdQQcgRWpEAg1CMcA5t2CUohmbPg0XJXUD.png" alt="Logo" class="h-10">
            </a>
            <button id="closeMenuBtn" class="text-white focus:outline-none">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <div class="p-4">
                            <div class="flex space-x-2 mb-6">
                    <a href="login.html" class="btn-secondary flex-1 text-center">Login</a>
                    <a href="register.html" class="btn-primary flex-1 text-center">Sign Up</a>
                </div>
                        
            <nav class="space-y-1">
                <a href="index.html" class="block py-3 px-4 rounded-lg bg-[#1A1428] text-[#2FE6DE]">
                    <i class="fas fa-home mr-2"></i> Home
                </a>
                <a href="markets.html" class="block py-3 px-4 rounded-lg text-white">
                    <i class="fas fa-chart-bar mr-2"></i> Markets
                </a>
                <div class="mobile-dropdown">
                    <button class="w-full text-left py-3 px-4 rounded-lg flex items-center justify-between text-white">
                        <span><i class="fas fa-exchange-alt mr-2"></i> Trade</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="pl-8 pb-2 hidden">
                        <a href="login.html" class="block py-2 text-gray-400 hover:text-white">Spot</a>
                        <a href="login.html" class="block py-2 text-gray-400 hover:text-white">Margin</a>
                        <a href="login.html" class="block py-2 text-gray-400 hover:text-white">Bot Trading</a>
                        <a href="login.html" class="block py-2 text-gray-400 hover:text-white">Copy Trading</a>
                    </div>
                </div>
                
                <a href="about.html" class="block py-3 px-4 rounded-lg text-white">
                    <i class="fas fa-info-circle mr-2"></i> About
                </a>
                
                <a href="contact.html" class="block py-3 px-4 rounded-lg text-white">
                    <i class="fas fa-envelope mr-2"></i> Contact
                </a>
            </nav>
            
            <div class="mt-8 pt-6 border-t border-[#2FE6DE]/10">
                <div class="flex justify-center space-x-4">
                    <a href="#" class="text-gray-400 hover:text-[#2FE6DE] transition-colors">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#2FE6DE] transition-colors">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#2FE6DE] transition-colors">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-[#2FE6DE] transition-colors">
                        <i class="fab fa-telegram text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <main>
        <!-- Hero Section with Slider -->
<div class="bg-[#0D091C] py-16 md:py-24 relative overflow-hidden">
    <!-- Background elements -->
    <div class="absolute top-20 right-20 w-64 h-64 bg-[#2FE6DE]/10 rounded-full filter blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-80 h-80 bg-[#2FE6DE]/5 rounded-full filter blur-3xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 mb-10 lg:mb-0">
                <div class="hero-slider-content">
                    <!-- Slide 1 -->
                    <div class="hero-slide active" data-slide="1">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                            <span class="text-white">Multiple Investment </span><br>
                            <span class="text-[#2FE6DE]">Strategies</span>
                        </h1>
                        
                        <p class="text-gray-300 text-lg mb-8 max-w-xl">
                           We offer a comprehensive lineup of traditional and alternative strategies designed to help you grow your wealth, preserve your wealth and everything in between.
                        </p>
                    </div>
                    
                    <!-- Slide 2 -->
                    <div class="hero-slide" data-slide="2">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                            <span class="text-white">Designed To Help </span><br>
                            <span class="text-[#2FE6DE]">You Manage Wealth</span>
                        </h1>
                        
                        <p class="text-gray-300 text-lg mb-8 max-w-xl">
                            We offer a comprehensive lineup of traditional and alternative strategies designed to help you grow your wealth, preserve your wealth and everything in between.
                        </p>
                    </div>
                    
                    <!-- Slide 3 -->
                    <div class="hero-slide" data-slide="3">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                            <span class="text-white">Secure & Fast</span><br>
                            <span class="text-[#2FE6DE]">Transactions</span>
                        </h1>
                        
                        <p class="text-gray-300 text-lg mb-8 max-w-xl">
                            We offer a comprehensive lineup of traditional and alternative strategies designed to help you grow your wealth, preserve your wealth and everything in between.
                        </p>
                    </div>
                </div>
                
                <!-- Slider Navigation -->
                <div class="flex space-x-2 mb-8">
                    <button class="hero-nav-dot active" data-slide="1">
                        <span class="block w-3 h-3 rounded-full bg-[#2FE6DE]"></span>
                    </button>
                    <button class="hero-nav-dot" data-slide="2">
                        <span class="block w-3 h-3 rounded-full bg-[#2FE6DE]/30"></span>
                    </button>
                    <button class="hero-nav-dot" data-slide="3">
                        <span class="block w-3 h-3 rounded-full bg-[#2FE6DE]/30"></span>
                    </button>
                </div>
                
                <!-- Get Started Button -->
<div class="bg-[#1A1428]/50 p-4 rounded-xl border border-[#2FE6DE]/10 mb-6 max-w-md">
    <a href="register.html" class="block bg-[#2FE6DE] text-black font-medium px-8 py-4 rounded-lg hover:brightness-110 transition-all text-center">
        Get Started
    </a>
</div>
            </div>
            
            <!-- Right Side - Hero SVG Illustrations -->
            <div class="lg:w-1/2 relative">
                <div class="hero-slider-illustrations relative z-10">
                    <!-- Illustration 1 -->
                    <div class="hero-illustration active" data-slide="1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600" class="w-full h-auto md:max-w-lg max-w-sm mx-auto">
                            <!-- Trading Dashboard Illustration -->
                            <rect x="100" y="100" width="600" height="400" rx="20" fill="#1A1428" stroke="#2FE6DE" stroke-opacity="0.3" stroke-width="2"/>
                            
                            <!-- Chart Area -->
                            <rect x="120" y="180" width="360" height="300" rx="10" fill="#0D091C"/>
                            <polyline points="120,380 180,320 240,350 300,280 360,300 420,250 480,280" stroke="#2FE6DE" stroke-width="3" fill="none"/>
                            <circle cx="180" cy="320" r="5" fill="#2FE6DE"/>
                            <circle cx="240" cy="350" r="5" fill="#2FE6DE"/>
                            <circle cx="300" cy="280" r="5" fill="#2FE6DE"/>
                            <circle cx="360" cy="300" r="5" fill="#2FE6DE"/>
                            <circle cx="420" cy="250" r="5" fill="#2FE6DE"/>
                            <circle cx="480" cy="280" r="5" fill="#2FE6DE"/>
                            
                            <!-- Chart Grid Lines -->
                            <line x1="120" y1="230" x2="480" y2="230" stroke="#2FE6DE" stroke-opacity="0.1" stroke-width="1"/>
                            <line x1="120" y1="280" x2="480" y2="280" stroke="#2FE6DE" stroke-opacity="0.1" stroke-width="1"/>
                            <line x1="120" y1="330" x2="480" y2="330" stroke="#2FE6DE" stroke-opacity="0.1" stroke-width="1"/>
                            <line x1="120" y1="380" x2="480" y2="380" stroke="#2FE6DE" stroke-opacity="0.1" stroke-width="1"/>
                            <line x1="180" y1="180" x2="180" y2="480" stroke="#2FE6DE" stroke-opacity="0.1" stroke-width="1"/>
                            <line x1="240" y1="180" x2="240" y2="480" stroke="#2FE6DE" stroke-opacity="0.1" stroke-width="1"/>
                            <line x1="300" y1="180" x2="300" y2="480" stroke="#2FE6DE" stroke-opacity="0.1" stroke-width="1"/>
                            <line x1="360" y1="180" x2="360" y2="480" stroke="#2FE6DE" stroke-opacity="0.1" stroke-width="1"/>
                            <line x1="420" y1="180" x2="420" y2="480" stroke="#2FE6DE" stroke-opacity="0.1" stroke-width="1"/>
                            
                            <!-- Sidebar -->
                            <rect x="500" y="180" width="180" height="300" rx="10" fill="#0D091C"/>
                            
                            <!-- Sidebar Items -->
                            <rect x="520" y="200" width="140" height="40" rx="5" fill="#2FE6DE" fill-opacity="0.1"/>
                            <circle cx="540" cy="220" r="10" fill="#2FE6DE" fill-opacity="0.3"/>
                            <rect x="560" y="215" width="80" height="10" rx="2" fill="white" fill-opacity="0.5"/>
                            
                            <rect x="520" y="250" width="140" height="40" rx="5" fill="#2FE6DE" fill-opacity="0.1"/>
                            <circle cx="540" cy="270" r="10" fill="#2FE6DE" fill-opacity="0.3"/>
                            <rect x="560" y="265" width="80" height="10" rx="2" fill="white" fill-opacity="0.5"/>
                            
                            <rect x="520" y="300" width="140" height="40" rx="5" fill="#2FE6DE" fill-opacity="0.1"/>
                            <circle cx="540" cy="320" r="10" fill="#2FE6DE" fill-opacity="0.3"/>
                            <rect x="560" y="315" width="80" height="10" rx="2" fill="white" fill-opacity="0.5"/>
                            
                            <rect x="520" y="350" width="140" height="40" rx="5" fill="#2FE6DE" fill-opacity="0.1"/>
                            <circle cx="540" cy="370" r="10" fill="#2FE6DE" fill-opacity="0.3"/>
                            <rect x="560" y="365" width="80" height="10" rx="2" fill="white" fill-opacity="0.5"/>
                            
                            <rect x="520" y="400" width="140" height="40" rx="5" fill="#2FE6DE" fill-opacity="0.1"/>
                            <circle cx="540" cy="420" r="10" fill="#2FE6DE" fill-opacity="0.3"/>
                            <rect x="560" y="415" width="80" height="10" rx="2" fill="white" fill-opacity="0.5"/>
                            
                            <!-- Header -->
                            <rect x="120" y="120" width="560" height="40" rx="5" fill="#0D091C"/>
                            <circle cx="140" cy="140" r="10" fill="#2FE6DE"/>
                            <rect x="160" y="135" width="100" height="10" rx="2" fill="white" fill-opacity="0.7"/>
                            <rect x="500" y="135" width="60" height="10" rx="2" fill="#2FE6DE" fill-opacity="0.5"/>
                            <rect x="570" y="135" width="60" height="10" rx="2" fill="#2FE6DE" fill-opacity="0.5"/>
                            
                            <!-- Floating Elements -->
                            <circle cx="650" cy="80" r="30" fill="#2FE6DE" fill-opacity="0.1"/>
                            <circle cx="700" cy="150" r="20" fill="#2FE6DE" fill-opacity="0.1"/>
                            <circle cx="80" cy="200" r="25" fill="#2FE6DE" fill-opacity="0.1"/>
                            <circle cx="50" cy="350" r="15" fill="#2FE6DE" fill-opacity="0.1"/>
                        </svg>
                    </div>
                    
                    <!-- Illustration 2 -->
                    <div class="hero-illustration" data-slide="2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600" class="w-full h-auto md:max-w-lg max-w-sm mx-auto">
                            <!-- AI Bot Trading Illustration -->
                            <circle cx="400" cy="300" r="180" fill="#1A1428" stroke="#2FE6DE" stroke-opacity="0.3" stroke-width="2"/>
                            
                            <!-- Robot Head -->
                            <rect x="340" y="200" width="120" height="100" rx="20" fill="#0D091C" stroke="#2FE6DE" stroke-width="2"/>
                            
                            <!-- Robot Eyes -->
                            <circle cx="370" cy="230" r="15" fill="#2FE6DE" fill-opacity="0.3"/>
                            <circle cx="370" cy="230" r="8" fill="#2FE6DE"/>
                            <circle cx="430" cy="230" r="15" fill="#2FE6DE" fill-opacity="0.3"/>
                            <circle cx="430" cy="230" r="8" fill="#2FE6DE"/>
                            
                            <!-- Robot Mouth -->
                            <rect x="365" y="260" width="70" height="10" rx="5" fill="#2FE6DE" fill-opacity="0.5"/>
                            <rect x="365" y="275" width="30" height="5" rx="2" fill="#2FE6DE" fill-opacity="0.5"/>
                            <rect x="405" y="275" width="30" height="5" rx="2" fill="#2FE6DE" fill-opacity="0.5"/>
                            
                            <!-- Robot Antennas -->
                            <line x1="360" y1="200" x2="350" y2="170" stroke="#2FE6DE" stroke-width="2"/>
                            <circle cx="350" cy="170" r="5" fill="#2FE6DE"/>
                            <line x1="440" y1="200" x2="450" y2="170" stroke="#2FE6DE" stroke-width="2"/>
                            <circle cx="450" cy="170" r="5" fill="#2FE6DE"/>
                            
                            <!-- Robot Body -->
                            <rect x="320" y="310" width="160" height="120" rx="20" fill="#0D091C" stroke="#2FE6DE" stroke-width="2"/>
                            
                            <!-- Robot Control Panel -->
                            <rect x="340" y="330" width="120" height="80" rx="10" fill="#1A1428"/>
                            
                            <!-- Robot Buttons and Lights -->
                            <circle cx="360" cy="350" r="8" fill="#2FE6DE"/>
                            <circle cx="390" cy="350" r="8" fill="#2FE6DE" fill-opacity="0.6"/>
                            <circle cx="420" cy="350" r="8" fill="#2FE6DE" fill-opacity="0.3"/>
                            
                            <rect x="350" y="370" width="100" height="10" rx="5" fill="#2FE6DE" fill-opacity="0.2"/>
                            <rect x="350" y="390" width="70" height="10" rx="5" fill="#2FE6DE" fill-opacity="0.4"/>
                            
                            <!-- Stock Symbols Floating Around -->
                            <text x="250" y="200" font-family="Arial" font-size="20" fill="#2FE6DE">AAPL</text>
                            <text x="500" y="220" font-family="Arial" font-size="20" fill="#2FE6DE">MSFT</text>
                            <text x="300" y="400" font-family="Arial" font-size="20" fill="#2FE6DE">GOOGL</text>
                            <text x="480" y="380" font-family="Arial" font-size="20" fill="#2FE6DE">TSLA</text>
                            <text x="520" y="300" font-family="Arial" font-size="20" fill="#2FE6DE">AMZN</text>
                            <text x="220" y="300" font-family="Arial" font-size="20" fill="#2FE6DE">NVDA</text>
                            
                            <!-- Data Streams -->
                            <path d="M250,210 C270,230 290,240 320,310" stroke="#2FE6DE" stroke-opacity="0.3" stroke-width="1" fill="none" stroke-dasharray="5,5"/>
                            <path d="M500,230 C480,250 460,270 480,310" stroke="#2FE6DE" stroke-opacity="0.3" stroke-width="1" fill="none" stroke-dasharray="5,5"/>
                            <path d="M300,390 C310,380 315,370 320,360" stroke="#2FE6DE" stroke-opacity="0.3" stroke-width="1" fill="none" stroke-dasharray="5,5"/>
                            <path d="M480,370 C470,360 465,350 460,340" stroke="#2FE6DE" stroke-opacity="0.3" stroke-width="1" fill="none" stroke-dasharray="5,5"/>
                            <path d="M510,300 C490,300 480,300 480,310" stroke="#2FE6DE" stroke-opacity="0.3" stroke-width="1" fill="none" stroke-dasharray="5,5"/>
                            <path d="M230,300 C250,300 270,300 320,310" stroke="#2FE6DE" stroke-opacity="0.3" stroke-width="1" fill="none" stroke-dasharray="5,5"/>
                            
                            <!-- Floating Elements -->
                            <circle cx="200" cy="150" r="30" fill="#2FE6DE" fill-opacity="0.1"/>
                            <circle cx="600" cy="200" r="40" fill="#2FE6DE" fill-opacity="0.1"/>
                            <circle cx="550" cy="450" r="25" fill="#2FE6DE" fill-opacity="0.1"/>
                            <circle cx="250" cy="450" r="35" fill="#2FE6DE" fill-opacity="0.1"/>
                        </svg>
                    </div>
                    
                    <!-- Illustration 3 -->
                    <div class="hero-illustration" data-slide="3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600" class="w-full h-auto md:max-w-lg max-w-sm mx-auto">
                            <!-- Secure Transactions Illustration -->
                            <rect x="250" y="150" width="300" height="300" rx="20" fill="#1A1428" stroke="#2FE6DE" stroke-opacity="0.3" stroke-width="2"/>
                            
                            <!-- Lock Body -->
                            <rect x="325" y="250" width="150" height="150" rx="10" fill="#0D091C" stroke="#2FE6DE" stroke-width="3"/>
                            
                            <!-- Lock Shackle -->
                            <path d="M350,250 L350,200 Q400,180 450,200 L450,250" fill="none" stroke="#2FE6DE" stroke-width="8" stroke-linecap="round"/>
                            
                            <!-- Keyhole -->
                            <circle cx="400" cy="325" r="25" fill="#1A1428" stroke="#2FE6DE" stroke-width="2"/>
                            <rect x="395" y="325" width="10" height="25" rx="5" fill="#1A1428" stroke="#2FE6DE" stroke-width="2"/>
                            
                            <!-- Digital Elements -->
                            <circle cx="250" cy="150" r="10" fill="#2FE6DE" fill-opacity="0.5"/>
                            <line x1="250" y1="150" x2="300" y2="200" stroke="#2FE6DE" stroke-opacity="0.3" stroke-width="1" stroke-dasharray="5,5"/>
                            
                            <circle cx="550" cy="150" r="10" fill="#2FE6DE" fill-opacity="0.5"/>
                            <line x1="550" y1="150" x2="500" y2="200" stroke="#2FE6DE" stroke-opacity="0.3" stroke-width="1" stroke-dasharray="5,5"/>
                            
                            <circle cx="250" cy="450" r="10" fill="#2FE6DE" fill-opacity="0.5"/>
                            <line x1="250" y1="450" x2="300" y2="400" stroke="#2FE6DE" stroke-opacity="0.3" stroke-width="1" stroke-dasharray="5,5"/>
                            
                            <circle cx="550" cy="450" r="10" fill="#2FE6DE" fill-opacity="0.5"/>
                            <line x1="550" y1="450" x2="500" y2="400" stroke="#2FE6DE" stroke-opacity="0.3" stroke-width="1" stroke-dasharray="5,5"/>
                            
                            <!-- Binary Code Background -->
                            <text x="270" y="180" font-family="monospace" font-size="10" fill="#2FE6DE" fill-opacity="0.3">10110101</text>
                            <text x="270" y="195" font-family="monospace" font-size="10" fill="#2FE6DE" fill-opacity="0.3">01001010</text>
                            <text x="270" y="210" font-family="monospace" font-size="10" fill="#2FE6DE" fill-opacity="0.3">11010010</text>
                            
                            <text x="450" y="180" font-family="monospace" font-size="10" fill="#2FE6DE" fill-opacity="0.3">10110101</text>
                            <text x="450" y="195" font-family="monospace" font-size="10" fill="#2FE6DE" fill-opacity="0.3">01001010</text>
                            <text x="450" y="210" font-family="monospace" font-size="10" fill="#2FE6DE" fill-opacity="0.3">11010010</text>
                            
                            <text x="270" y="420" font-family="monospace" font-size="10" fill="#2FE6DE" fill-opacity="0.3">10110101</text>
                            <text x="270" y="435" font-family="monospace" font-size="10" fill="#2FE6DE" fill-opacity="0.3">01001010</text>
                            <text x="270" y="450" font-family="monospace" font-size="10" fill="#2FE6DE" fill-opacity="0.3">11010010</text>
                            
                            <text x="450" y="420" font-family="monospace" font-size="10" fill="#2FE6DE" fill-opacity="0.3">10110101</text>
                            <text x="450" y="435" font-family="monospace" font-size="10" fill="#2FE6DE" fill-opacity="0.3">01001010</text>
                            <text x="450" y="450" font-family="monospace" font-size="10" fill="#2FE6DE" fill-opacity="0.3">11010010</text>
                            
                            <!-- Shield Elements -->
                            <path d="M200,300 L200,350 Q250,400 300,350 L300,300 Q250,320 200,300 Z" fill="#0D091C" stroke="#2FE6DE" stroke-opacity="0.5" stroke-width="1"/>
                            <path d="M500,300 L500,350 Q550,400 600,350 L600,300 Q550,320 500,300 Z" fill="#0D091C" stroke="#2FE6DE" stroke-opacity="0.5" stroke-width="1"/>
                            
                            <!-- Floating Elements -->
                            <circle cx="150" cy="200" r="30" fill="#2FE6DE" fill-opacity="0.1"/>
                            <circle cx="650" cy="200" r="40" fill="#2FE6DE" fill-opacity="0.1"/>
                            <circle cx="650" cy="400" r="25" fill="#2FE6DE" fill-opacity="0.1"/>
                            <circle cx="150" cy="400" r="35" fill="#2FE6DE" fill-opacity="0.1"/>
                        </svg>
                    </div>
                </div>
                <div class="absolute top-1/4 right-1/4 w-64 h-64 bg-[#2FE6DE]/10 rounded-full filter blur-3xl -z-10"></div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Counter Section -->
<div class="py-12 bg-[#0A0714]">
    <div class="container mx-auto px-4">
        <div class="bg-[#1A1428] rounded-xl p-8 border border-[#2FE6DE]/10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="counter-item">
                    <div class="text-[#2FE6DE] text-2xl md:text-4xl font-bold mb-2" data-count="1">
                        <span class="counter">1</span><span>M+</span>
                    </div>
                    <p class="text-gray-300">Active Traders</p>
                </div>
                
                <div class="counter-item">
                    <div class="text-[#2FE6DE] text-2xl md:text-4xl font-bold mb-2" data-count="150">
                        <span class="counter">150</span><span>+</span>
                    </div>
                    <p class="text-gray-300">Countries Served</p>
                </div>
                
                <div class="counter-item">
                    <div class="text-[#2FE6DE] text-2xl md:text-4xl font-bold mb-2" data-count="5">
                        <span class="counter">5</span><span>M+</span>
                    </div>
                    <p class="text-gray-300">Daily Transactions</p>
                </div>
                
                <div class="counter-item">
                    <div class="text-[#2FE6DE] text-2xl md:text-4xl font-bold mb-2" data-count="25">
                        <span class="counter">25</span><span>B+</span>
                    </div>
                    <p class="text-gray-300">Trading Volume</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="relative rounded-2xl overflow-hidden mb-16 shadow-2xl shadow-[#2FE6DE]/10 border border-[#2FE6DE]/10 group">
                <div class="absolute inset-0 bg-gradient-to-r from-[#2FE6DE]/20 to-purple-600/20 blur-xl opacity-30 group-hover:opacity-40 transition-opacity"></div>
                <img src="public/images/elon-musk.jpg" 
                     alt="About BlackRock" 
                     class="w-full h-64 md:h-[500px] object-cover rounded-2xl relative z-10 transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0A0714] via-transparent to-transparent z-20 rounded-2xl"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 md:p-10 z-30">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-[#2FE6DE]/20 flex items-center justify-center">
                            <i class="fas fa-chart-line text-[#2FE6DE]"></i>
                        </div>
                        <div>
                            <div class="text-white font-medium">LARRY FINK</div>
                            <div class="text-gray-300 text-sm">Chairman & Ceo</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <P>Larry fink Co-founded BlackRock in 1988 and has served as its Chairman and CEO ever since, guiding its transformation into the world's largest asset manager, overseeing over $11.5 trillion in assets</P>

<!-- Our Values -->
    <div class="py-16 bg-gradient-to-b from-[#0D091C] to-[#0A0714]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <div class="inline-block mb-4 px-4 py-1 bg-[#2FE6DE]/10 rounded-full border border-[#2FE6DE]/20">
                    <span class="text-[#2FE6DE] text-sm font-medium">What We Stand For</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Our <span class="text-[#2FE6DE]">Values</span></h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">The principles that guide everything we do.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-[#1A1428] rounded-xl border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all hover:transform hover:-translate-y-1 hover:shadow-lg hover:shadow-[#2FE6DE]/5 overflow-hidden">
                    <div class="h-48 relative overflow-hidden">
                        <img src="public/images/WhatsApp%20Image%202025-07-25%20at%2001.31.58_a689b84d.jpg" 
                             alt="ELON REEVE MUSK"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1A1428]/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-4">
                            <div class="w-12 h-12 rounded-full bg-[#2FE6DE]/20 flex items-center justify-center">
                                <i class="fas fa-lock text-[#2FE6DE] text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-semibold mb-3">Security First</h3>
                        <p class="text-gray-300 mb-4">Founded
1988 (by Larry Fink & team) Private Partnership with ELON REEVE MUSK 
Assets Under Management
~$11.5–11.6 trillion (2024–25)
Key Offerings
iShares ETFs, Aladdin analytics, public/private market investments
Strategic Direction
Expanded into private markets via major acquisitions (GIP, HPS, Preqin)
2025–2030 Ambitions
$400B private fundraising; double market cap; increase private revenue
Leadership Transition
Continued focus on digital assets & ESG via new leadership roles
Global Risk Practices
Heightened data-security measures—especially in China</p>
                        <ul class="text-gray-400 space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-[#2FE6DE] mt-1 mr-2"></i>
                                <span>Multi-factor authentication</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-[#2FE6DE] mt-1 mr-2"></i>
                                <span>Cold storage for 95% of assets</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-[#2FE6DE] mt-1 mr-2"></i>
                                <span>Regular security audits</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-[#1A1428] rounded-xl border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all hover:transform hover:-translate-y-1 hover:shadow-lg hover:shadow-[#2FE6DE]/5 overflow-hidden">
                    <div class="h-48 relative overflow-hidden">
                        <img src="public/images/WhatsApp%20Image%202025-07-27%20at%2020.44.48_f5568352.jpg" 
                             alt="Innovation" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1A1428]/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-4">
                            <div class="w-12 h-12 rounded-full bg-[#F59E0B]/20 flex items-center justify-center">
                                <i class="fas fa-lightbulb text-[#F59E0B] text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-semibold mb-3">Innovation</h3>
                        <p class="text-gray-300 mb-4">Today, we are hosting our 2025 Investor Day, which offers a look into BlackRock’s long-term vision. Our leadership team shares how we’re positioning the firm to be stronger, more resilient, and drive greater value for clients and stakeholders through 2030 and beyond.</p>
                        <ul class="text-gray-400 space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-[#2FE6DE] mt-1 mr-2"></i>
                                <span>AI-powered trading algorithms</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-[#2FE6DE] mt-1 mr-2"></i>
                                <span>Advanced charting tools</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-[#2FE6DE] mt-1 mr-2"></i>
                                <span>Continuous platform improvements</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-[#1A1428] rounded-xl border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all hover:transform hover:-translate-y-1 hover:shadow-lg hover:shadow-[#2FE6DE]/5 overflow-hidden">
                    <div class="h-48 relative overflow-hidden">
                        <img src="public/images/WhatsApp%20Image%202025-07-27%20at%2020.42.38_5f5e32e5.jpg" 
                             alt="Community" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1A1428]/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-4">
                            <div class="w-12 h-12 rounded-full bg-[#10B981]/20 flex items-center justify-center">
                                <i class="fas fa-users text-[#10B981] text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-semibold mb-3">Community</h3>
                        <p class="text-gray-300 mb-4">We believe in the power of community, fostering an environment where traders can learn from each other and grow together.</p>
                        <ul class="text-gray-400 space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-[#2FE6DE] mt-1 mr-2"></i>
                                <span>Active trader forums</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-[#2FE6DE] mt-1 mr-2"></i>
                                <span>Educational resources</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-[#2FE6DE] mt-1 mr-2"></i>
                                <span>Community-driven feature development</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Popular Stocks Section -->
<div class="py-12 bg-gradient-to-b from-[#0A0714] to-[#0D091C]">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold mb-4">Popular <span class="text-[#2FE6DE]">Stocks</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto">Track and trade the most popular stocks with real-time data and advanced tools</p>
        </div>
        
        <!-- Market Status Indicator -->
        <div class="flex justify-center mb-6">
            <div class="bg-[#1A1428] rounded-lg px-4 py-2 border border-[#2FE6DE]/10">
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm text-gray-300" id="market-status">Market Status: <span class="text-green-400">Loading...</span></span>
                    <span class="text-xs text-gray-400" id="last-updated"></span>
                </div>
            </div>
        </div>
        
        <!-- Desktop Table View (hidden on mobile) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full bg-[#1A1428] rounded-xl overflow-hidden border border-[#2FE6DE]/10">
                <thead>
                    <tr class="bg-[#0D091C]">
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-400">#</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-400">Company</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-400">Price</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-400">Change</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-400">Change %</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-400">Volume</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-400">Market Cap</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-gray-400">Action</th>
                    </tr>
                </thead>
                <tbody id="stock-market-table" class="divide-y divide-[#2FE6DE]/5">
                    <!-- Loading state will be replaced by JavaScript -->
                </tbody>
            </table>
        </div>
        
        <!-- Mobile Card View (shown only on mobile) -->
        <div class="md:hidden">
            <div id="stock-market-cards" class="space-y-4">
                <!-- Loading state will be replaced by JavaScript -->
            </div>
        </div>
        
        <!-- Quick Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
            <div class="bg-[#1A1428] rounded-lg p-4 border border-[#2FE6DE]/10">
                <div class="text-center">
                    <div class="text-green-400 text-xl font-bold" id="gainers-count">-</div>
                    <div class="text-xs text-gray-400">Gainers</div>
                </div>
            </div>
            <div class="bg-[#1A1428] rounded-lg p-4 border border-[#2FE6DE]/10">
                <div class="text-center">
                    <div class="text-red-400 text-xl font-bold" id="losers-count">-</div>
                    <div class="text-xs text-gray-400">Losers</div>
                </div>
            </div>
            <div class="bg-[#1A1428] rounded-lg p-4 border border-[#2FE6DE]/10">
                <div class="text-center">
                    <div class="text-[#2FE6DE] text-xl font-bold" id="total-volume">-</div>
                    <div class="text-xs text-gray-400">Total Volume</div>
                </div>
            </div>
            <div class="bg-[#1A1428] rounded-lg p-4 border border-[#2FE6DE]/10">
                <div class="text-center">
                    <div class="text-[#2FE6DE] text-xl font-bold" id="avg-change">-</div>
                    <div class="text-xs text-gray-400">Avg Change</div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <a href="markets.html" class="inline-block px-6 py-3 bg-[#2FE6DE]/10 text-[#2FE6DE] rounded-lg border border-[#2FE6DE]/30 hover:bg-[#2FE6DE]/20 transition-colors">
                View All Markets <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</div>

<script>
// Advanced Stock Market Widget
class StockMarketWidget {
    constructor() {
        this.stocks = [
            {
                symbol: 'AAPL',
                name: 'Apple Inc.',
                price: 175.43,
                change: 2.67,
                changePercent: 1.55,
                volume: 65432100,
                marketCap: 2786543210000,
                sector: 'Technology'
            },
            {
                symbol: 'MSFT',
                name: 'Microsoft Corporation',
                price: 384.30,
                change: -1.15,
                changePercent: -0.30,
                volume: 32156789,
                marketCap: 2856432100000,
                sector: 'Technology'
            },
            {
                symbol: 'GOOGL',
                name: 'Alphabet Inc.',
                price: 142.65,
                change: 1.25,
                changePercent: 0.88,
                volume: 28765432,
                marketCap: 1786543210000,
                sector: 'Communication'
            },
            {
                symbol: 'TSLA',
                name: 'Tesla, Inc.',
                price: 248.48,
                change: 5.73,
                changePercent: 2.36,
                volume: 89543210,
                marketCap: 789876543210,
                sector: 'Consumer Cyclical'
            },
            {
                symbol: 'AMZN',
                name: 'Amazon.com Inc.',
                price: 156.77,
                change: -0.85,
                changePercent: -0.54,
                volume: 45321098,
                marketCap: 1623456789012,
                sector: 'Consumer Cyclical'
            },
            {
                symbol: 'NVDA',
                name: 'NVIDIA Corporation',
                price: 875.15,
                change: 18.90,
                changePercent: 2.21,
                volume: 76543210,
                marketCap: 2156789012345,
                sector: 'Technology'
            },
            {
                symbol: 'META',
                name: 'Meta Platforms Inc.',
                price: 498.37,
                change: 7.23,
                changePercent: 1.47,
                volume: 23456789,
                marketCap: 1265789012345,
                sector: 'Communication'
            },
            {
                symbol: 'BRK.B',
                name: 'Berkshire Hathaway Inc.',
                price: 432.15,
                change: 2.45,
                changePercent: 0.57,
                volume: 4567890,
                marketCap: 958765432109,
                sector: 'Financial Services'
            }
        ];
        
        this.apiKeys = {
            alphavantage: 'demo', // Replace with your API key
            finnhub: 'demo',      // Replace with your API key
            iex: 'demo'           // Replace with your API key
        };
        
        this.init();
    }
    
    init() {
        this.showLoadingState();
        this.simulateRealTimeUpdates();
        this.loadStockData();
    }
    
    showLoadingState() {
        // Show loading in table
        const tableBody = document.getElementById('stock-market-table');
        if (tableBody) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-400">
                        <div class="flex justify-center items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-[#2FE6DE]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Loading market data...</span>
                        </div>
                    </td>
                </tr>
            `;
        }
        
        // Show loading in cards
        const cardsContainer = document.getElementById('stock-market-cards');
        if (cardsContainer) {
            cardsContainer.innerHTML = `
                <div class="bg-[#1A1428] rounded-xl p-4 border border-[#2FE6DE]/10">
                    <div class="flex justify-center items-center py-8 text-gray-400">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-[#2FE6DE]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Loading market data...</span>
                    </div>
                </div>
            `;
        }
    }
    
    async loadStockData() {
        try {
            // Try to fetch real data from API
            const liveData = await this.fetchLiveData();
            if (liveData && liveData.length > 0) {
                this.stocks = liveData;
            } else {
                // Simulate realistic price movements on fallback data
                this.simulatePriceMovements();
            }
            
            // Display the data
            this.displayStocks();
            this.updateQuickStats();
            this.updateMarketStatus();
            
        } catch (error) {
            console.log('Using fallback data:', error.message);
            // Use fallback data with simulated movements
            this.simulatePriceMovements();
            this.displayStocks();
            this.updateQuickStats();
            this.updateMarketStatus();
        }
    }
    
    async fetchLiveData() {
        // Try different APIs in order of preference
        const apis = [
            () => this.fetchFromAlphaVantage(),
            () => this.fetchFromFinnhub(),
            () => this.fetchFromIEX()
        ];
        
        for (const apiCall of apis) {
            try {
                const data = await apiCall();
                if (data && data.length > 0) {
                    return data;
                }
            } catch (error) {
                console.log('API call failed, trying next...');
                continue;
            }
        }
        
        return null;
    }
    
    async fetchFromAlphaVantage() {
        // Note: This is a demo implementation
        // In production, replace with your actual API key and implement proper batch requests
        throw new Error('Alpha Vantage API not configured');
    }
    
    async fetchFromFinnhub() {
        // Note: This is a demo implementation
        // In production, replace with your actual API key
        throw new Error('Finnhub API not configured');
    }
    
    async fetchFromIEX() {
        // Note: This is a demo implementation
        // In production, replace with your actual API key
        throw new Error('IEX Cloud API not configured');
    }
    
    simulatePriceMovements() {
        // Simulate realistic price movements
        this.stocks = this.stocks.map(stock => {
            const volatility = Math.random() * 0.03; // 0-3% volatility
            const direction = Math.random() > 0.5 ? 1 : -1;
            const priceChange = stock.price * volatility * direction;
            
            return {
                ...stock,
                price: Math.max(0.01, stock.price + priceChange),
                change: priceChange,
                changePercent: (priceChange / stock.price) * 100,
                volume: stock.volume + Math.floor(Math.random() * 1000000)
            };
        });
    }
    
    simulateRealTimeUpdates() {
        // Update prices every 5 seconds to simulate real-time data
        setInterval(() => {
            this.simulatePriceMovements();
            this.displayStocks();
            this.updateQuickStats();
        }, 5000);
    }
    
    displayStocks() {
        this.displayTable();
        this.displayMobileCards();
    }
    
    displayTable() {
        const tableBody = document.getElementById('stock-market-table');
        if (!tableBody) return;
        
        let html = '';
        
        this.stocks.slice(0, 8).forEach((stock, index) => {
            const changeClass = stock.change >= 0 ? 'text-green-500' : 'text-red-500';
            const changeBgClass = stock.change >= 0 ? 'bg-green-500/10' : 'bg-red-500/10';
            const logoUrl = this.getStockLogo(stock.symbol);
            
            html += `
                <tr class="hover:bg-[#2FE6DE]/5 transition-colors animate-fadeIn">
                    <td class="px-6 py-4 text-gray-400 font-medium">${index + 1}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 mr-3 rounded-full bg-[#2FE6DE]/10 flex items-center justify-center overflow-hidden">
                                <img src="${logoUrl}" alt="${stock.symbol}" class="w-6 h-6" 
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-6 h-6 rounded-full bg-[#2FE6DE]/20 flex items-center justify-center" style="display:none">
                                    <span class="text-xs font-bold text-[#2FE6DE]">${stock.symbol.charAt(0)}</span>
                                </div>
                            </div>
                            <div>
                                <div class="font-medium text-white">${stock.name}</div>
                                <div class="text-gray-400 text-sm">${stock.symbol}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right font-mono font-medium text-white">
                        ${this.formatCurrency(stock.price)}
                    </td>
                    <td class="px-6 py-4 text-right font-mono ${changeClass}">
                        ${this.formatChange(stock.change)}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <span class="px-2 py-1 ${changeBgClass} ${changeClass} rounded-md font-mono text-sm">
                            ${this.formatPercentage(stock.changePercent)}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right text-gray-300 font-mono">
                        ${this.formatVolume(stock.volume)}
                    </td>
                    <td class="px-6 py-4 text-right text-gray-300 font-mono">
                        ${this.formatVolume(stock.marketCap)}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="px-4 py-1 bg-[#2FE6DE]/10 text-[#2FE6DE] rounded-lg hover:bg-[#2FE6DE]/20 transition-colors text-sm font-medium">
                            Trade
                        </button>
                    </td>
                </tr>
            `;
        });
        
        tableBody.innerHTML = html;
    }
    
    displayMobileCards() {
        const cardsContainer = document.getElementById('stock-market-cards');
        if (!cardsContainer) return;
        
        let html = '';
        
        this.stocks.slice(0, 8).forEach((stock, index) => {
            const changeClass = stock.change >= 0 ? 'text-green-500' : 'text-red-500';
            const logoUrl = this.getStockLogo(stock.symbol);
            
            html += `
                <div class="bg-[#1A1428] rounded-xl p-4 border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all animate-fadeIn">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <div class="w-12 h-12 mr-3 flex-shrink-0 rounded-full bg-[#2FE6DE]/10 flex items-center justify-center overflow-hidden">
                                <img src="${logoUrl}" alt="${stock.symbol}" class="w-8 h-8" 
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-8 h-8 rounded-full bg-[#2FE6DE]/20 flex items-center justify-center" style="display:none">
                                    <span class="text-sm font-bold text-[#2FE6DE]">${stock.symbol.charAt(0)}</span>
                                </div>
                            </div>
                            <div>
                                <div class="font-medium text-white">${stock.name}</div>
                                <div class="text-gray-400 text-xs">${stock.symbol} • ${stock.sector}</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-mono font-medium text-white">${this.formatCurrency(stock.price)}</div>
                            <div class="${changeClass} text-sm font-mono">${this.formatPercentage(stock.changePercent)}</div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 mb-3">
                        <div class="bg-[#0D091C]/50 rounded-lg p-2">
                            <div class="text-xs text-gray-400">Change</div>
                            <div class="text-sm font-medium font-mono ${changeClass}">${this.formatChange(stock.change)}</div>
                        </div>
                        <div class="bg-[#0D091C]/50 rounded-lg p-2">
                            <div class="text-xs text-gray-400">Volume</div>
                            <div class="text-sm font-medium font-mono text-gray-300">${this.formatVolume(stock.volume)}</div>
                        </div>
                    </div>
                    
                    <button class="block w-full py-2 text-center bg-[#2FE6DE]/10 text-[#2FE6DE] rounded-lg hover:bg-[#2FE6DE]/20 transition-colors text-sm font-medium">
                        Trade ${stock.symbol}
                    </button>
                </div>
            `;
        });
        
        cardsContainer.innerHTML = html;
    }
    
    updateQuickStats() {
        const gainers = this.stocks.filter(stock => stock.change > 0).length;
        const losers = this.stocks.filter(stock => stock.change < 0).length;
        const totalVolume = this.stocks.reduce((sum, stock) => sum + stock.volume, 0);
        const avgChange = this.stocks.reduce((sum, stock) => sum + stock.changePercent, 0) / this.stocks.length;
        
        document.getElementById('gainers-count').textContent = gainers;
        document.getElementById('losers-count').textContent = losers;
        document.getElementById('total-volume').textContent = this.formatVolume(totalVolume);
        document.getElementById('avg-change').textContent = this.formatPercentage(avgChange);
    }
    
    updateMarketStatus() {
        const now = new Date();
        const marketOpen = new Date();
        marketOpen.setHours(9, 30, 0, 0); // 9:30 AM
        const marketClose = new Date();
        marketClose.setHours(16, 0, 0, 0); // 4:00 PM
        
        const isWeekday = now.getDay() >= 1 && now.getDay() <= 5;
        const isMarketHours = now >= marketOpen && now <= marketClose;
        const isOpen = isWeekday && isMarketHours;
        
        const statusElement = document.getElementById('market-status');
        const lastUpdatedElement = document.getElementById('last-updated');
        
        if (statusElement) {
            statusElement.innerHTML = isOpen ? 
                'Market Status: <span class="text-green-400">Open</span>' : 
                'Market Status: <span class="text-red-400">Closed</span>';
        }
        
        if (lastUpdatedElement) {
            lastUpdatedElement.textContent = `Updated: ${now.toLocaleTimeString()}`;
        }
    }
    
    getStockLogo(symbol) {
        const logoMap = {
            'AAPL': 'https://logo.clearbit.com/apple.com',
            'MSFT': 'https://logo.clearbit.com/microsoft.com',
            'GOOGL': 'https://logo.clearbit.com/google.com',
            'TSLA': 'https://logo.clearbit.com/tesla.com',
            'AMZN': 'https://logo.clearbit.com/amazon.com',
            'NVDA': 'https://logo.clearbit.com/nvidia.com',
            'META': 'https://logo.clearbit.com/meta.com',
            'BRK.B': 'https://logo.clearbit.com/berkshirehathaway.com'
        };
        
        return logoMap[symbol] || `https://via.placeholder.com/32/2FE6DE/000000?text=${symbol.charAt(0)}`;
    }
    
    formatCurrency(value) {
        return '$' + value.toLocaleString('en-US', { 
            minimumFractionDigits: 2, 
            maximumFractionDigits: 2 
        });
    }
    
    formatChange(value) {
        const sign = value >= 0 ? '+' : '';
        return `${sign}${value.toFixed(2)}`;
    }
    
    formatPercentage(value) {
        const sign = value >= 0 ? '+' : '';
        return `${sign}${value.toFixed(2)}%`;
    }
    
    formatVolume(value) {
        if (value >= 1e12) {
            return (value / 1e12).toFixed(1) + 'T';
        } else if (value >= 1e9) {
            return (value / 1e9).toFixed(1) + 'B';
        } else if (value >= 1e6) {
            return (value / 1e6).toFixed(1) + 'M';
        } else if (value >= 1e3) {
            return (value / 1e3).toFixed(1) + 'K';
        } else {
            return value.toLocaleString();
        }
    }
}

// Initialize the widget when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new StockMarketWidget();
});
</script>

<style>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeIn {
    animation: fadeIn 0.5s ease-out;
}

/* Table hover effects */
#stock-market-table tr:hover {
    background-color: rgba(47, 230, 222, 0.05);
}

/* Mobile card hover effects */
#stock-market-cards .bg-\[#1A1428\]:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(47, 230, 222, 0.1);
}

/* Loading animation */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Responsive font sizes */
@media (max-width: 640px) {
    .font-mono {
        font-size: 0.875rem;
    }
}
</style>

<!-- Investment Plans Section -->
<div class="py-16 bg-[#0A0714]">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Investment <span class="text-[#2FE6DE]">Plans</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto">Choose the perfect investment plan that suits your trading goals and financial objectives</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="bg-[#1A1428] rounded-xl p-6 border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all">
                                        
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-semibold mb-2">Gold Plan</h3>
                        <div class="text-[#2FE6DE] text-4xl font-bold mb-2">$25,000<span class="text-lg text-gray-400">/7-2days</span></div>
                        <p class="text-gray-400">Short Investment Plan</p>
                        <p class="text-xs text-[#2FE6DE] mt-1">*Minimum $5,000</p>
                    </div>
                    
                    <ul class="space-y-3 mb-8">
    
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Manual Trading support</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Live market webinars and strategy sessions</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Personal account manager</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>VIP access to investment seminars and exclusive events</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Access to trading tools</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Unlimited trades</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Advanced market analysis</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>24/7 dedicated support</span>
        </li>
    </ul>

                    <a href="register.html" class="block w-full py-3 text-center bg-[#2FE6DE]/10 text-[#2FE6DE] hover:bg-[#2FE6DE]/20 rounded-lg transition-all">
                        Get Started
                    </a>
                </div>
                            <div class="bg-[#1A1428] rounded-xl p-6 border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all">
                                        
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-semibold mb-2">VIP Plan</h3>
                        <div class="text-[#2FE6DE] text-4xl font-bold mb-2">$100,000<span class="text-lg text-gray-400">/7-4days</span></div>
                        <p class="text-gray-400">Medium-Term Investment Plan</p>
                        <p class="text-xs text-[#2FE6DE] mt-1">*Minimum $25,000</p>
                    </div>
                    
                    <ul class="space-y-3 mb-8">
    
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Manual Trading support</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Live market webinars and strategy sessions</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Personal account manager</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>VIP access to investment seminars and exclusive events</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Access to trading tools</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Unlimited trades</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Advanced market analysis</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>24/7 dedicated support</span>
        </li>
    </ul>

                    <a href="register.html" class="block w-full py-3 text-center bg-[#2FE6DE]/10 text-[#2FE6DE] hover:bg-[#2FE6DE]/20 rounded-lg transition-all">
                        Get Started
                    </a>
                </div>
                            <div class="bg-[#1A1428] rounded-xl p-6 border-2 border-[#2FE6DE] relative transform hover:scale-105 transition-all">
                                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-[#2FE6DE] text-black px-4 py-1 rounded-full text-sm font-medium">
                            Recommended
                        </div>
                                        
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-semibold mb-2">Membership Card Plan</h3>
                        <div class="text-[#2FE6DE] text-4xl font-bold mb-2">$1,000,000<span class="text-lg text-gray-400">/7-4days</span></div>
                        <p class="text-gray-400">Long Term Investment Plan</p>
                        <p class="text-xs text-[#2FE6DE] mt-1">*Minimum $100,000</p>
                    </div>
                    
                    <ul class="space-y-3 mb-8">
    
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Manual Trading support</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Live market webinars and strategy sessions</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Personal account manager</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>VIP access to investment seminars and exclusive events</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Access to trading tools</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Unlimited trades</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>Advanced market analysis</span>
        </li>
            <li class="flex items-center ">
            <i class="fas fa-check text-green-500 mr-3"></i>
            <span>24/7 dedicated support</span>
        </li>
    </ul>

                    <a href="register.html" class="block w-full py-3 text-center bg-[#2FE6DE] text-black hover:brightness-110 rounded-lg transition-all">
                        Get Started
                    </a>
                </div>
                    </div>
    </div>
</div>

<!-- Trading Options Section -->
<div class="py-16 bg-gradient-to-b from-[#0A0714] to-[#0D091C]">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Start Trading <span class="text-[#2FE6DE]">Now</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto">Choose how you want to trade and invest in stocks and financial markets</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
             <div class="bg-[#1A1428] rounded-xl p-6 border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all">
                <div class="w-12 h-12 rounded-full bg-[#2FE6DE]/10 flex items-center justify-center mb-4">
                    <i class="fas fa-chart-line text-[#2FE6DE] text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Stock Trading</h3>
                <p class="text-gray-400 mb-4">Trade stocks with advanced charts and real-time market data</p>
                <a href="login.html" class="text-[#2FE6DE] hover:underline flex items-center text-sm">
                    Trade Now <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            
            <div class="bg-[#1A1428] rounded-xl p-6 border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all">
                <div class="w-12 h-12 rounded-full bg-[#2FE6DE]/10 flex items-center justify-center mb-4">
                    <i class="fas fa-copy text-[#2FE6DE] text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Copy Trading</h3>
                <p class="text-gray-400 mb-4">Automatically copy the trades of successful traders</p>
                <a href="login.html" class="text-[#2FE6DE] hover:underline flex items-center text-sm">
                    Start Copying <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            
            <div class="bg-[#1A1428] rounded-xl p-6 border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all">
                <div class="w-12 h-12 rounded-full bg-[#2FE6DE]/10 flex items-center justify-center mb-4">
                    <i class="fas fa-robot text-[#2FE6DE] text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Bot Trading</h3>
                <p class="text-gray-400 mb-4">Automate your trading with AI-powered bots and strategies</p>
                <a href="login.html" class="text-[#2FE6DE] hover:underline flex items-center text-sm">
                    Start Bot <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Mobile App Section -->
<div class="py-16 bg-[#0A0714]">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 mb-10 lg:mb-0 order-2 lg:order-1">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Trade on the go.<br><span class="text-[#2FE6DE]">Anywhere, anytime.</span></h2>
                <p class="text-gray-300 text-lg mb-8 max-w-xl">
                    Download our mobile app to trade stocks, manage your portfolio, and stay updated with market trends on the go.
                </p>
                
                <div class="flex flex-row gap-4 mb-8 justify-center sm:justify-start">
                    <a href="#" class="flex items-center justify-center bg-[#1A1428] rounded-xl px-4 py-3 border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-colors w-1/2 sm:w-auto">
                        <i class="fab fa-apple text-xl sm:text-2xl mr-2 sm:mr-3"></i>
                        <div class="text-left">
                            <div class="text-xs text-gray-400">Download on the</div>
                            <div class="text-sm sm:text-base font-medium">App Store</div>
                        </div>
                    </a>
                    <a href="#" class="flex items-center justify-center bg-[#1A1428] rounded-xl px-4 py-3 border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-colors w-1/2 sm:w-auto">
                        <i class="fab fa-google-play text-xl sm:text-2xl mr-2 sm:mr-3"></i>
                        <div class="text-left">
                            <div class="text-xs text-gray-400">Get it on</div>
                            <div class="text-sm sm:text-base font-medium">Google Play</div>
                        </div>
                    </a>
                </div>
                
                <div class="flex items-center">
                    <div class="flex -space-x-2">
                        <div class="w-10 h-10 rounded-full border-2 border-[#0A0714] bg-[#1A1428] flex items-center justify-center overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="#2FE6DE">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                            </svg>
                        </div>
                        <div class="w-10 h-10 rounded-full border-2 border-[#0A0714] bg-[#1A1428] flex items-center justify-center overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="#2FE6DE">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                            </svg>
                        </div>
                        <div class="w-10 h-10 rounded-full border-2 border-[#0A0714] bg-[#1A1428] flex items-center justify-center overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="#2FE6DE">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="text-[#2FE6DE] font-medium">1M+ Active Users</div>
                        <div class="text-gray-400 text-sm">Join our growing community</div>
                    </div>
                </div>
            </div>
            
            <div class="lg:w-1/2 relative order-1 lg:order-2">
                <div class="relative z-10 animate-float">
                   <img src="images/default.svg" alt="Mobile App Mockup" class="mx-auto max-w-xs h-auto w-full">
                </div>
                <div class="absolute top-1/4 right-1/4 w-64 h-64 bg-[#2FE6DE]/10 rounded-full filter blur-3xl -z-10"></div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-16 bg-gradient-to-b from-[#0D091C] to-[#0A0714]">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Why Choose <span class="text-[#2FE6DE]">BlackRock</span></h2>
            <p class="text-gray-400 max-w-2xl mx-auto">Our platform offers a comprehensive suite of tools and features designed to enhance your trading experience.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-[#1A1428] rounded-xl p-6 border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all">
                <div class="w-14 h-14 rounded-full bg-[#2FE6DE]/10 flex items-center justify-center mb-6">
                    <i class="fas fa-shield-alt text-[#2FE6DE] text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Advanced Security</h3>
                <p class="text-gray-400">Industry-leading security measures to protect your assets.</p>
            </div>
            
            <div class="bg-[#1A1428] rounded-xl p-6 border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all">
                <div class="w-14 h-14 rounded-full bg-[#2FE6DE]/10 flex items-center justify-center mb-6">
                    <i class="fas fa-chart-line text-[#2FE6DE] text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Professional Tools</h3>
                <p class="text-gray-400">Advanced charting and real-time market data for informed decisions.</p>
            </div>
            
            <div class="bg-[#1A1428] rounded-xl p-6 border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all">
                <div class="w-14 h-14 rounded-full bg-[#2FE6DE]/10 flex items-center justify-center mb-6">
                    <i class="fas fa-robot text-[#2FE6DE] text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">AI-Powered Trading</h3>
                <p class="text-gray-400">Utilize our AI-powered trading bots based on predefined strategies.</p>
            </div>
            
            <div class="bg-[#1A1428] rounded-xl p-6 border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all">
                <div class="w-14 h-14 rounded-full bg-[#2FE6DE]/10 flex items-center justify-center mb-6">
                    <i class="fas fa-bolt text-[#2FE6DE] text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Fast Execution</h3>
                <p class="text-gray-400">High-performance matching engine for minimal latency and slippage.</p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-16 bg-[#0A0714] relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#2FE6DE]/5 rounded-full filter blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#2FE6DE]/5 rounded-full filter blur-3xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="bg-gradient-to-r from-[#1A1428] to-[#0D091C] rounded-2xl p-8 md:p-12 border border-[#2FE6DE]/10 shadow-xl">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Start Your Trading Journey?</h2>
                <p class="text-gray-300 text-lg mb-10 max-w-2xl mx-auto">
                    Join thousands of traders worldwide and experience the power of our advanced trading platform.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="register.html" class="bg-[#2FE6DE] text-black font-medium px-8 py-4 rounded-lg hover:brightness-110 transition-all text-center">
                        Create Account
                    </a>
                    <a href="contact.html" class="bg-transparent text-white font-medium px-8 py-4 rounded-lg border border-[#2FE6DE]/30 hover:border-[#2FE6DE] transition-colors text-center">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Real-time Stock API Integration -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fetch stock data
    fetchStockData();
    
    // Initialize counters
    initCounters();
    
    // Refresh data every 60 seconds
    setInterval(fetchStockData, 60000);
});

async function fetchStockData() {
    try {
        // Using mock data for demonstration - replace with your preferred stock API
        const mockStockData = [
            {
                symbol: 'AAPL',
                name: 'Apple Inc.',
                price: 175.25,
                change: 2.45,
                changePercent: 1.42,
                volume: 65432100,
                marketCap: 2786543210000,
                logo: 'https://logo.clearbit.com/apple.com'
            },
            {
                symbol: 'MSFT',
                name: 'Microsoft Corporation',
                price: 384.50,
                change: -1.25,
                changePercent: -0.32,
                volume: 32156789,
                marketCap: 2856432100000,
                logo: 'https://logo.clearbit.com/microsoft.com'
            },
            {
                symbol: 'GOOGL',
                name: 'Alphabet Inc.',
                price: 142.15,
                change: 0.85,
                changePercent: 0.60,
                volume: 28765432,
                marketCap: 1786543210000,
                logo: 'https://logo.clearbit.com/google.com'
            },
            {
                symbol: 'TSLA',
                name: 'Tesla, Inc.',
                price: 248.75,
                change: 5.20,
                changePercent: 2.13,
                volume: 89543210,
                marketCap: 789876543210,
                logo: 'https://logo.clearbit.com/tesla.com'
            },
            {
                symbol: 'AMZN',
                name: 'Amazon.com Inc.',
                price: 156.80,
                change: -0.95,
                changePercent: -0.60,
                volume: 45321098,
                marketCap: 1623456789012,
                logo: 'https://logo.clearbit.com/amazon.com'
            },
            {
                symbol: 'NVDA',
                name: 'NVIDIA Corporation',
                price: 875.30,
                change: 15.75,
                changePercent: 1.83,
                volume: 76543210,
                marketCap: 2156789012345,
                logo: 'https://logo.clearbit.com/nvidia.com'
            }
        ];
        
        // For production, replace with actual API call:
        /*
        const response = await fetch('https://api.finnhub.io/api/v1/stock/symbol?exchange=US&token=YOUR_API_KEY');
        const data = await response.json();
        */
        
        // Update the market overview table and cards
        updateMarketTable(mockStockData);
        updateMarketCards(mockStockData);
        
    } catch (error) {
        console.error('Error fetching stock data:', error);
        
        // Show error message in table
        document.querySelector('#stock-market-table').innerHTML = `
            <tr>
                <td colspan="8" class="px-6 py-8 text-center text-red-400">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    Unable to load market data. Please try again later.
                </td>
            </tr>
        `;
        
        // Show error message in cards
        document.querySelector('#stock-market-cards').innerHTML = `
            <div class="bg-[#1A1428] rounded-xl p-4 border border-[#2FE6DE]/10">
                <div class="flex justify-center items-center py-8 text-red-400">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>Unable to load market data. Please try again later.</span>
                </div>
            </div>
        `;
    }
}

function updateMarketTable(data) {
    const tableBody = document.querySelector('#stock-market-table');
    if (!tableBody) return;
    
    let tableHTML = '';
    
    // Generate table rows for each stock
    data.slice(0, 6).forEach((stock, index) => {
        const priceChangeClass = stock.change >= 0 ? 'text-green-500' : 'text-red-500';
        const priceChangeBgClass = stock.change >= 0 ? 'bg-green-500/10' : 'bg-red-500/10';
        
        tableHTML += `
            <tr class="hover:bg-[#2FE6DE]/5 transition-colors">
                <td class="px-6 py-4 text-gray-400">${index + 1}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 mr-3 rounded-full bg-[#2FE6DE]/10 flex items-center justify-center overflow-hidden">
                            <img src="${stock.logo}" alt="${stock.symbol}" class="w-6 h-6" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <span class="text-xs font-bold text-[#2FE6DE]" style="display:none">${stock.symbol.charAt(0)}</span>
                        </div>
                        <div>
                            <div class="font-medium">${stock.name}</div>
                            <div class="text-gray-400 text-sm">${stock.symbol}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-right font-medium">${formatCurrency(stock.price)}</td>
                <td class="px-6 py-4 text-right">
                    <span class="${priceChangeClass}">${formatChange(stock.change)}</span>
                </td>
                <td class="px-6 py-4 text-right">
                    <span class="px-2 py-1 ${priceChangeBgClass} ${priceChangeClass} rounded-md">${formatPercentage(stock.changePercent)}</span>
                </td>
                <td class="px-6 py-4 text-right text-gray-300">${formatVolume(stock.volume)}</td>
                <td class="px-6 py-4 text-right text-gray-300">${formatVolume(stock.marketCap)}</td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="px-4 py-1 bg-[#2FE6DE]/10 text-[#2FE6DE] rounded-lg hover:bg-[#2FE6DE]/20 transition-colors text-sm">Trade</a>
                </td>
            </tr>
        `;
    });
    
    tableBody.innerHTML = tableHTML;
}

function updateMarketCards(data) {
    const cardsContainer = document.querySelector('#stock-market-cards');
    if (!cardsContainer) return;
    
    let cardsHTML = '';
    
    // Generate card for each stock
    data.slice(0, 6).forEach((stock, index) => {
        const priceChangeClass = stock.change >= 0 ? 'text-green-500' : 'text-red-500';
        
        cardsHTML += `
            <div class="bg-[#1A1428] rounded-xl p-4 border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center">
                        <div class="w-10 h-10 mr-3 flex-shrink-0 rounded-full bg-[#2FE6DE]/10 flex items-center justify-center overflow-hidden">
                            <img src="${stock.logo}" alt="${stock.symbol}" class="w-6 h-6" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <span class="text-xs font-bold text-[#2FE6DE]" style="display:none">${stock.symbol.charAt(0)}</span>
                        </div>
                        <div>
                            <div class="font-medium">${stock.name}</div>
                            <div class="text-gray-400 text-xs">${stock.symbol}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-medium">${formatCurrency(stock.price)}</div>
                        <div class="${priceChangeClass} text-sm">${formatPercentage(stock.changePercent)}</div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-2 mb-3">
                    <div class="bg-[#0D091C]/50 rounded-lg p-2">
                        <div class="text-xs text-gray-400">Change</div>
                        <div class="text-sm font-medium ${priceChangeClass}">${formatChange(stock.change)}</div>
                    </div>
                    <div class="bg-[#0D091C]/50 rounded-lg p-2">
                        <div class="text-xs text-gray-400">Volume</div>
                        <div class="text-sm font-medium">${formatVolume(stock.volume)}</div>
                    </div>
                </div>
                
                <a href="#" class="block w-full py-2 text-center bg-[#2FE6DE]/10 text-[#2FE6DE] rounded-lg hover:bg-[#2FE6DE]/20 transition-colors text-sm">Trade</a>
            </div>
        `;
    });
    
    cardsContainer.innerHTML = cardsHTML;
}

function initCounters() {
    const counters = document.querySelectorAll('.counter');
    
    counters.forEach(counter => {
        const target = parseInt(counter.textContent.replace(/,/g, ''));
        const increment = target / 100;
        
        let current = 0;
        const updateCounter = () => {
            if (current < target) {
                current += increment;
                counter.textContent = Math.ceil(current).toLocaleString('en-US');
                setTimeout(updateCounter, 10);
            } else {
                counter.textContent = target.toLocaleString('en-US');
            }
        };
        
        // Start the counter animation when the element is in view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateCounter();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        observer.observe(counter);
    });
}

// Helper functions for formatting
function formatCurrency(value) {
    return '$' + value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function formatChange(value) {
    const sign = value >= 0 ? '+' : '';
    return `${sign}${value.toFixed(2)}`;
}

function formatPercentage(value) {
    const sign = value >= 0 ? '+' : '';
    return `${sign}${value.toFixed(2)}%`;
}

function formatVolume(value) {
    if (value >= 1e12) {
        return (value / 1e12).toFixed(1) + 'T';
    } else if (value >= 1e9) {
        return (value / 1e9).toFixed(1) + 'B';
    } else if (value >= 1e6) {
        return (value / 1e6).toFixed(1) + 'M';
    } else if (value >= 1e3) {
        return (value / 1e3).toFixed(1) + 'K';
    } else {
        return value.toFixed(0);
    }
}

// Hero Slider Functionality
function initHeroSlider() {
    const slides = document.querySelectorAll('.hero-slide');
    const illustrations = document.querySelectorAll('.hero-illustration');
    const dots = document.querySelectorAll('.hero-nav-dot');
    let currentSlide = 1;
    let slideInterval;

    // Function to change slide
    function goToSlide(slideNumber) {
        // Update content slides
        slides.forEach(slide => {
            slide.classList.remove('active');
            if (slide.dataset.slide == slideNumber) {
                slide.classList.add('active');
            }
        });

        // Update illustrations
        illustrations.forEach(illustration => {
            illustration.classList.remove('active');
            if (illustration.dataset.slide == slideNumber) {
                illustration.classList.add('active');
            }
        });

        // Update navigation dots
        dots.forEach(dot => {
            dot.classList.remove('active');
            dot.querySelector('span').classList.remove('bg-[#2FE6DE]');
            dot.querySelector('span').classList.add('bg-[#2FE6DE]/30');
            
            if (dot.dataset.slide == slideNumber) {
                dot.classList.add('active');
                dot.querySelector('span').classList.remove('bg-[#2FE6DE]/30');
                dot.querySelector('span').classList.add('bg-[#2FE6DE]');
            }
        });

        currentSlide = parseInt(slideNumber);
    }

    // Set up click handlers for dots
    dots.forEach(dot => {
        dot.addEventListener('click', function() {
            const slideNumber = this.dataset.slide;
            goToSlide(slideNumber);
            resetInterval();
        });
    });

    // Auto-advance slides
    function startInterval() {
        slideInterval = setInterval(() => {
            let nextSlide = currentSlide + 1;
            if (nextSlide > slides.length) {
                nextSlide = 1;
            }
            goToSlide(nextSlide);
        }, 5000);
    }

    function resetInterval() {
        clearInterval(slideInterval);
        startInterval();
    }

    // Initialize the slider
    startInterval();
}

// Initialize hero slider when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize hero slider
    initHeroSlider();
});
</script>

<style>
/* Button Styles */
.btn-primary {
    display: inline-block;
    background-color: rgba(47, 230, 222, 0.1);
    color: #2FE6DE;
    border-radius: 0.5rem;
    transition: all 0.2s;
}

.btn-primary:hover {
    background-color: rgba(47, 230, 222, 0.2);
}

.btn-secondary {
    display: inline-block;
    background-color: rgba(47, 230, 222, 0.1);
    color: #2FE6DE;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    border: 1px solid rgba(47, 230, 222, 0.3);
    transition: all 0.2s;
}

.btn-secondary:hover {
    background-color: rgba(47, 230, 222, 0.2);
    border-color: rgba(47, 230, 222, 0.5);
}

/* Animation */
@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
    100% {
        transform: translateY(0px);
    }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

/* Hero Slider Styles */
.hero-slide {
    display: none;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.hero-slide.active {
    display: block;
    opacity: 1;
}

.hero-illustration {
    display: none;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.hero-illustration.active {
    display: block;
    opacity: 1;
    animation: float 6s ease-in-out infinite;
}

.hero-nav-dot {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.hero-nav-dot span {
    transition: all 0.3s ease;
}

.hero-nav-dot:hover span {
    background-color: rgba(47, 230, 222, 0.8) !important;
}
</style>
    </main>

    <footer class="bg-[#0D091C] border-t border-[#2FE6DE]/10 py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                <div class="lg:col-span-2">
                    <img src="storage/settings/bv05CPQdQQcgRWpEAg1CMcA5t2CUohmbPg0XJXUD.png" alt="Logo" class="h-8 mb-4">
                    <p class="text-gray-400 text-sm mb-4">A modern trading platform with advanced features and real-time market data.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-[#1A1428] flex items-center justify-center text-gray-400 hover:text-[#2FE6DE] transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-[#1A1428] flex items-center justify-center text-gray-400 hover:text-[#2FE6DE] transition-colors">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-[#1A1428] flex items-center justify-center text-gray-400 hover:text-[#2FE6DE] transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-[#1A1428] flex items-center justify-center text-gray-400 hover:text-[#2FE6DE] transition-colors">
                            <i class="fab fa-telegram"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-white">Products</h3>
                    <ul class="space-y-2">
                        <li><a href="login.html" class="text-gray-400 hover:text-[#2FE6DE] transition-colors">Spot Trading</a></li>
                        <li><a href="login.html" class="text-gray-400 hover:text-[#2FE6DE] transition-colors">Margin Trading</a></li>
                        <li><a href="login.html" class="text-gray-400 hover:text-[#2FE6DE] transition-colors">Bot Trading</a></li>
                        <li><a href="login.html" class="text-gray-400 hover:text-[#2FE6DE] transition-colors">Copy Trading</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-white">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="contact/index.html#faq" class="text-gray-400 hover:text-[#2FE6DE] transition-colors">FAQ</a></li>
                        <li><a href="contact.html" class="text-gray-400 hover:text-[#2FE6DE] transition-colors">Contact Us</a></li>
                        <li><a href="terms.html" class="text-gray-400 hover:text-[#2FE6DE] transition-colors">Terms of Service</a></li>
                        <li><a href="privacy.html" class="text-gray-400 hover:text-[#2FE6DE] transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-10 pt-6 border-t border-[#2FE6DE]/10 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; 2025 BlackRock. All rights reserved.</p>
                <div class="flex items-center space-x-4">
                    <a href="terms.html" class="text-gray-400 hover:text-[#2FE6DE] text-sm transition-colors">Terms</a>
                    <a href="privacy.html" class="text-gray-400 hover:text-[#2FE6DE] text-sm transition-colors">Privacy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Live Activity Notification Popup -->
    <div id="live-notification" class="live-notification" style="display: none;">
        <div class="notification-content">
            <div class="notification-icon" id="notification-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="notification-text">
                <div class="notification-message" id="notification-message"></div>
                <div class="notification-details" id="notification-details"></div>
                <div class="notification-time" id="notification-time"></div>
            </div>
            <div class="notification-close" onclick="closeNotification()">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>

    <script src="js/crypto-api.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simulate loading progress
        const progressBar = document.getElementById('loader-progress');
        let width = 0;
        const interval = setInterval(function() {
            if (width >= 100) {
                clearInterval(interval);
                // Hide loader when loading is complete
                setTimeout(function() {
                    const loader = document.getElementById('site-loader');
                    if (loader) {
                        loader.classList.add('opacity-0');
                        setTimeout(function() {
                            loader.style.display = 'none';
                        }, 500);
                    }
                }, 200);
            } else {
                width += Math.floor(Math.random() * 10) + 1;
                if (width > 100) width = 100;
                if (progressBar) progressBar.style.width = width + '%';
            }
        }, 150);
    });
</script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
            // Fetch cryptocurrency data from CoinGecko API
            fetchCryptoData();
            
            // Refresh data every 60 seconds
            setInterval(fetchCryptoData, 60000);
            
            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const closeMenuBtn = document.getElementById('closeMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            
            if (mobileMenuBtn && mobileMenu && closeMenuBtn) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });
                
                closeMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.remove('active');
                    document.body.style.overflow = '';
                });
            }
            
            // Mobile dropdowns
            const mobileDropdowns = document.querySelectorAll('.mobile-dropdown');
            mobileDropdowns.forEach(dropdown => {
                const button = dropdown.querySelector('button');
                const content = dropdown.querySelector('div');
                
                button.addEventListener('click', () => {
                    content.classList.toggle('hidden');
                    const icon = button.querySelector('.fas.fa-chevron-down');
                    if (icon) {
                        icon.classList.toggle('fa-chevron-down');
                        icon.classList.toggle('fa-chevron-up');
                    }
                });
            });

            // Add locale handling for JavaScript
            window.locale = 'en';
            window.translations = "investment";

            // Initialize live notifications
            initializeLiveNotifications();
        });

        // Live Activity Notification System
        function initializeLiveNotifications() {
            const activities = [
                {
                    type: 'investment',
                    name: 'Michael Johnson',
                    country: 'United States',
                    amount: 25000,
                    icon: 'fas fa-chart-line'
                },
                {
                    type: 'withdrawal',
                    name: 'Sarah Chen',
                    country: 'Singapore',
                    amount: 8500,
                    icon: 'fas fa-money-bill-wave'
                },
                {
                    type: 'deposit',
                    name: 'David Rodriguez',
                    country: 'Spain',
                    amount: 12000,
                    icon: 'fas fa-plus-circle'
                },
                {
                    type: 'investment',
                    name: 'Emma Thompson',
                    country: 'United Kingdom',
                    amount: 45000,
                    icon: 'fas fa-chart-line'
                },
                {
                    type: 'withdrawal',
                    name: 'Alex Petrov',
                    country: 'Russia',
                    amount: 18500,
                    icon: 'fas fa-money-bill-wave'
                },
                {
                    type: 'deposit',
                    name: 'Maria Silva',
                    country: 'Brazil',
                    amount: 9200,
                    icon: 'fas fa-plus-circle'
                },
                {
                    type: 'investment',
                    name: 'James Wilson',
                    country: 'Australia',
                    amount: 33000,
                    icon: 'fas fa-chart-line'
                },
                {
                    type: 'withdrawal',
                    name: 'Fatima Al-Rashid',
                    country: 'UAE',
                    amount: 22000,
                    icon: 'fas fa-money-bill-wave'
                },
                {
                    type: 'deposit',
                    name: 'Pierre Dubois',
                    country: 'France',
                    amount: 15500,
                    icon: 'fas fa-plus-circle'
                },
                {
                    type: 'investment',
                    name: 'Yuki Tanaka',
                    country: 'Japan',
                    amount: 28000,
                    icon: 'fas fa-chart-line'
                },
                {
                    type: 'withdrawal',
                    name: 'Hans Mueller',
                    country: 'Germany',
                    amount: 14200,
                    icon: 'fas fa-money-bill-wave'
                },
                {
                    type: 'deposit',
                    name: 'Priya Sharma',
                    country: 'India',
                    amount: 7800,
                    icon: 'fas fa-plus-circle'
                },
                {
                    type: 'investment',
                    name: 'Carlos Mendoza',
                    country: 'Mexico',
                    amount: 19500,
                    icon: 'fas fa-chart-line'
                },
                {
                    type: 'withdrawal',
                    name: 'Anna Kowalski',
                    country: 'Poland',
                    amount: 11000,
                    icon: 'fas fa-money-bill-wave'
                },
                {
                    type: 'deposit',
                    name: 'Ahmed Hassan',
                    country: 'Egypt',
                    amount: 6500,
                    icon: 'fas fa-plus-circle'
                },
                {
                    type: 'investment',
                    name: 'Jennifer Lee',
                    country: 'South Korea',
                    amount: 38000,
                    icon: 'fas fa-chart-line'
                },
                {
                    type: 'withdrawal',
                    name: 'Roberto Rossi',
                    country: 'Italy',
                    amount: 16800,
                    icon: 'fas fa-money-bill-wave'
                },
                {
                    type: 'deposit',
                    name: 'Olga Petersen',
                    country: 'Norway',
                    amount: 23500,
                    icon: 'fas fa-plus-circle'
                }
            ];

            function showRandomNotification() {
                const activity = activities[Math.floor(Math.random() * activities.length)];
                const now = new Date();
                
                // Random time between 1-30 minutes ago
                const minutesAgo = Math.floor(Math.random() * 30) + 1;
                const timeAgo = minutesAgo === 1 ? '1 minute ago' : `${minutesAgo} minutes ago`;
                
                let message, details;
                
                switch(activity.type) {
                    case 'investment':
                        message = `${activity.name} from ${activity.country} just invested`;
                        details = `Successfully invested ${activity.amount.toLocaleString()} in trading portfolio`;
                        break;
                    case 'withdrawal':
                        message = `${activity.name} from ${activity.country} just withdrew`;
                        details = `Successfully withdrew ${activity.amount.toLocaleString()} to bank account`;
                        break;
                    case 'deposit':
                        message = `${activity.name} from ${activity.country} just deposited`;
                        details = `Successfully deposited ${activity.amount.toLocaleString()} to trading account`;
                        break;
                }
                
                showNotification(activity.type, message, details, timeAgo, activity.icon);
            }
            
            // Show first notification after 5 seconds
            setTimeout(showRandomNotification, 5000);
            
            // Show new notification every 5 seconds
            setInterval(showRandomNotification, 5000);
        }

        function showNotification(type, message, details, time, iconClass) {
            const notification = document.getElementById('live-notification');
            const icon = document.getElementById('notification-icon');
            const messageEl = document.getElementById('notification-message');
            const detailsEl = document.getElementById('notification-details');
            const timeEl = document.getElementById('notification-time');
            
            if (!notification) return;
            
            // Set content
            messageEl.textContent = message;
            detailsEl.textContent = details;
            timeEl.textContent = time;
            
            // Update icon
            icon.innerHTML = `<i class="${iconClass}"></i>`;
            
            // Update styling based on type
            notification.className = `live-notification ${type}`;
            icon.className = `notification-icon ${type}`;
            
            // Show notification
            notification.style.display = 'block';
            
            // Auto hide after 4 seconds (to avoid overlap with next notification)
            setTimeout(() => {
                hideNotification();
            }, 4000);
        }

        function hideNotification() {
            const notification = document.getElementById('live-notification');
            if (notification) {
                notification.classList.add('notification-hide');
                setTimeout(() => {
                    notification.style.display = 'none';
                    notification.classList.remove('notification-hide');
                }, 300);
            }
        }

        function closeNotification() {
            hideNotification();
        }

        async function fetchCryptoData() {
    try {
        // Fetch data for the top cryptocurrencies
        const response = await fetch('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&amp;order=market_cap_desc&amp;per_page=20&amp;page=1&amp;sparkline=false&amp;price_change_percentage=24h');
        
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        
        const data = await response.json();
        
        // Update the ticker
        updateTicker(data);
        
        // Update the market overview table and cards
        updateMarketTable(data);
        updateMarketCards(data);
        
    } catch (error) {
        console.error('Error fetching crypto data:', error);
        
        // Show error message in table
        const marketTable = document.querySelector('#crypto-market-table');
        if (marketTable) {
            marketTable.innerHTML = `
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-red-400">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Unable to load market data. Please try again later.
                    </td>
                </tr>
            `;
        }
        
        // Show error message in cards
        const marketCards = document.querySelector('#crypto-market-cards');
        if (marketCards) {
            marketCards.innerHTML = `
                <div class="bg-[#1A1428] rounded-xl p-4 border border-[#2FE6DE]/10">
                    <div class="flex justify-center items-center py-8 text-red-400">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>Unable to load market data. Please try again later.</span>
                    </div>
                </div>
            `;
        }
    }
}

function updateTicker(data) {
    const tickerContainer = document.getElementById('crypto-ticker');
    if (!tickerContainer) return;
    
    let tickerHTML = '';
    
    data.forEach(coin => {
        const priceChangeClass = coin.price_change_percentage_24h >= 0 ? 'text-green-500' : 'text-red-500';
        const priceChangeIcon = coin.price_change_percentage_24h >= 0 ? 'fa-caret-up' : 'fa-caret-down';
        
        tickerHTML += `
            <div class="ticker-item flex items-center mr-8">
                <img src="${coin.image}" alt="${coin.symbol.toUpperCase()}" class="w-5 h-5 mr-2">
                <span class="font-medium mr-1">${coin.symbol.toUpperCase()}</span>
                <span>${formatCurrency(coin.current_price)}</span>
                <span class="${priceChangeClass} ml-2">
                    <i class="fas ${priceChangeIcon} mr-1"></i>${formatPercentage(coin.price_change_percentage_24h)}
                </span>
            </div>
        `;
    });
    
    tickerContainer.innerHTML = tickerHTML;
}
function updateMarketTable(data) {
    const tableBody = document.querySelector('#crypto-market-table');
    if (!tableBody) return;
    
    let tableHTML = '';
    
    // Generate table rows for each cryptocurrency
    data.slice(0, 3).forEach((coin, index) => {
        const priceChangeClass = coin.price_change_percentage_24h >= 0 ? 'text-green-500' : 'text-red-500';
        const priceChangeBgClass = coin.price_change_percentage_24h >= 0 ? 'bg-green-500/10' : 'bg-red-500/10';
        
        tableHTML += `
            <tr class="hover:bg-[#2FE6DE]/5 transition-colors">
                <td class="px-6 py-4 text-gray-400">${index + 1}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <img src="${coin.image}" alt="${coin.symbol.toUpperCase()}" class="w-8 h-8 mr-3">
                        <div>
                            <div class="font-medium">${coin.name}</div>
                            <div class="text-gray-400 text-sm">${coin.symbol.toUpperCase()}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-right font-medium">${formatCurrency(coin.current_price)}</td>
                <td class="px-6 py-4 text-right">
                    <span class="px-2 py-1 ${priceChangeBgClass} ${priceChangeClass} rounded-md">${formatPercentage(coin.price_change_percentage_24h)}</span>
                </td>
                <td class="px-6 py-4 text-right text-gray-300">${formatVolume(coin.total_volume)}</td>
                <td class="px-6 py-4 text-right text-gray-300">${formatVolume(coin.market_cap)}</td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="px-4 py-1 bg-[#2FE6DE]/10 text-[#2FE6DE] rounded-lg hover:bg-[#2FE6DE]/20 transition-colors text-sm">Trade</a>
                </td>
            </tr>
        `;
    });
    
    tableBody.innerHTML = tableHTML;
}

function updateMarketCards(data) {
    const cardsContainer = document.querySelector('#crypto-market-cards');
    if (!cardsContainer) return;
    
    let cardsHTML = '';
    
    // Generate card for each cryptocurrency
    data.slice(0, 3).forEach((coin, index) => {
        const priceChangeClass = coin.price_change_percentage_24h >= 0 ? 'text-green-500' : 'text-red-500';
        
        cardsHTML += `
            <div class="bg-[#1A1428] rounded-xl p-4 border border-[#2FE6DE]/10 hover:border-[#2FE6DE]/30 transition-all">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center">
                        <div class="w-10 h-10 mr-3 flex-shrink-0">
                            <img src="${coin.image}" alt="${coin.symbol.toUpperCase()}" class="w-full h-full">
                        </div>
                        <div>
                            <div class="font-medium">${coin.name}</div>
                            <div class="text-gray-400 text-xs">${coin.symbol.toUpperCase()}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-medium">${formatCurrency(coin.current_price)}</div>
                        <div class="${priceChangeClass} text-sm">${formatPercentage(coin.price_change_percentage_24h)}</div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-2 mb-3">
                    <div class="bg-[#0D091C]/50 rounded-lg p-2">
                        <div class="text-xs text-gray-400">24h Volume</div>
                        <div class="text-sm font-medium">${formatVolume(coin.total_volume)}</div>
                    </div>
                    <div class="bg-[#0D091C]/50 rounded-lg p-2">
                        <div class="text-xs text-gray-400">Market Cap</div>
                        <div class="text-sm font-medium">${formatVolume(coin.market_cap)}</div>
                    </div>
                </div>
                
                <a href="#" class="block w-full py-2 text-center bg-[#2FE6DE]/10 text-[#2FE6DE] rounded-lg hover:bg-[#2FE6DE]/20 transition-colors text-sm">Trade</a>
            </div>
        `;
    });
    
    cardsContainer.innerHTML = cardsHTML;
}

// Helper functions for formatting
function formatCurrency(value) {
    // Format based on value size
    if (value >= 1000) {
        return '$' + value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } else if (value >= 1) {
        return '$' + value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 4 });
    } else {
        return '$' + value.toLocaleString('en-US', { minimumFractionDigits: 4, maximumFractionDigits: 6 });
    }
}

function formatPercentage(value) {
    const sign = value >= 0 ? '+' : '';
    return `${sign}${value.toFixed(2)}%`;
}

function formatVolume(value) {
    if (value >= 1e9) {
        return '$' + (value / 1e9).toFixed(1) + 'B';
    } else if (value >= 1e6) {
        return '$' + (value / 1e6).toFixed(1) + 'M';
    } else if (value >= 1e3) {
        return '$' + (value / 1e3).toFixed(1) + 'K';
    } else {
        return '$' + value.toFixed(0);
    }
}
    </script>
    <!-- TradingView Widget Script -->
<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>

<style>
/* Ticker Animation */
.ticker-wrap {
    width: 100%;
    overflow: hidden;
    height: 40px;
    padding: 0;
    box-sizing: border-box;
}

.ticker {
    display: flex;
    white-space: nowrap;
    padding-right: 100%;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
    animation-name: ticker;
    animation-duration: 30s;
}

.ticker-item {
    display: inline-flex;
    align-items: center;
    padding: 0 1rem;
}

@keyframes ticker {
    0% {
        transform: translate3d(0, 0, 0);
    }
    100% {
        transform: translate3d(-100%, 0, 0);
    }
}

/* Button Styles */
.btn-primary {
    display: inline-block;
    background-color: rgba(47, 230, 222, 0.1);
    color: #2FE6DE;
    border-radius: 0.5rem;
    transition: all 0.2s;
}

.btn-primary:hover {
    background-color: rgba(47, 230, 222, 0.2);
}

.btn-secondary {
    display: inline-block;
    background-color: rgba(47, 230, 222, 0.1);
    color: #2FE6DE;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    border: 1px solid rgba(47, 230, 222, 0.3);
    transition: all 0.2s;
}

.btn-secondary:hover {
    background-color: rgba(47, 230, 222, 0.2);
    border-color: rgba(47, 230, 222, 0.5);
}

/* Animation */
@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
    100% {
        transform: translateY(0px);
    }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

/* Line clamp for text truncation */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
    <!-- Livewire Scripts -->
<script src="livewire/livewire5dd3.js?id=cc800bf4"   data-csrf="QHTgDfeSDEhGixs61ktyfaAnqYfyNU0Xv8qcvRbs" data-update-uri="/livewire/update" data-navigate-once="true"></script>
        

</body>

<!-- Mirrored from www.blackrockinvestmentcorporation.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Aug 2025 18:11:14 GMT -->
</html>