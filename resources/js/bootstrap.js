import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/* BugSnag */
import BugsnagPerformance from '@bugsnag/browser-performance';
BugsnagPerformance.start({
	apiKey: '5de183f969f3ff7d0197a1b1031d45c4',
	releaseStage: import.meta.env.PROD ? 'production' : 'local'
});
