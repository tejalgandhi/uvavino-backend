import './styles.scss';
import { onDomReady } from 'cantil';
import * as data from './data.json';

const app = {
  init: () => {
    console.log(data);
  },

};

onDomReady().then(app.init);
