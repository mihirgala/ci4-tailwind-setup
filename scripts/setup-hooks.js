// Enables the repo's git hooks. Safe no-op when there is no git checkout, git is
// missing, or another tool already set core.hooksPath.
const { existsSync } = require('fs');
const { execSync } = require('child_process');

if (existsSync('.git')) {
    try {
        const current = execSync('git config --get core.hooksPath', { stdio: ['ignore', 'pipe', 'ignore'] }).toString().trim();
        if (!current) {
            execSync('git config core.hooksPath .githooks');
        }
    } catch (e) {
        // `git config --get` exits 1 when unset; any other failure (git missing) is ignored on purpose.
        try { execSync('git config core.hooksPath .githooks', { stdio: 'ignore' }); } catch (_) {}
    }
}
