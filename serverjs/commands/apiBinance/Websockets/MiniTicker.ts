import { BaseCommand } from '@adonisjs/core/build/standalone'
// eslint-disable-next-line @typescript-eslint/no-var-requires
const Binance = require('node-binance-api');
import Redis from '@ioc:Adonis/Addons/Redis'

export default class MiniTicker extends BaseCommand {
  /**
   * Command name is used to run the command
   */
  public static commandName = 'apiBinance:miniTicker'

  /**
   * Command description is displayed in the "help" output
   */
  public static description = ''

  public static settings = {
    /**
     * Set the following value to true, if you want to load the application
     * before running the command. Don't forget to call `node ace generate:manifest`
     * afterwards.
     */
    loadApp: true,

    /**
     * Set the following value to true, if you want this command to keep running until
     * you manually decide to exit the process. Don't forget to call
     * `node ace generate:manifest` afterwards.
     */
    stayAlive: true,
  }

  public async run() {
    const binance = new Binance();

    binance.websockets.miniTicker(markets => {
      for (const [key, value] of Object.entries(markets)) {
        Redis.set(`miniTicker:${key}`, JSON.stringify(value))
        //Redis.publish(`miniTicker:${key}`, JSON.stringify(value))
      }
    });

    //Redis.publish('sym-sym', 'nj cjj,otybt')

    binance.websockets.depthCache(['BNBBTC'], (symbol, depth) => {
      const bids = binance.sortBids(depth.bids);
      const asks = binance.sortAsks(depth.asks);

      Redis.set(`depthCache:${symbol}`, JSON.stringify({bids : bids, asks : asks}))

      //console.info(symbol + " depth cache update");
      //console.info("bids", bids);
      //console.info("asks", asks);
      //console.info("best bid: " + binance.first(bids));
      //console.info("best ask: " + binance.first(asks));
      //console.info("last updated: " + new Date(depth.eventTime));
    });

  }
}
