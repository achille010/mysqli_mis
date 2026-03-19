## Description

<!-- Provide a clear and concise description of what this PR does -->



## Type of Change

<!-- Mark the relevant option with an 'x' -->

- [ ] 🐛 Bug fix (non-breaking change which fixes an issue)
- [ ] ✨ New feature (non-breaking change which adds functionality)
- [ ] 💥 Breaking change (fix or feature that would cause existing functionality to not work as expected)
- [ ] 🔒 Security fix (addresses a security vulnerability)
- [ ] 📝 Documentation update (changes to README, comments, etc.)
- [ ] 🎨 Code style/refactoring (formatting, renaming, restructuring)
- [ ] 🗄️ Database changes (schema modifications, migrations)
- [ ] ⚡ Performance improvement
- [ ] 🧪 Test addition or update

## Related Issues

<!-- Link to related issues using #issue_number -->

Closes #
Fixes #
Related to #

## Changes Made

<!-- List the specific changes made in this PR -->

- 
- 
- 

## Security Considerations

<!-- REQUIRED: Address security implications of your changes -->

### SQL Injection Prevention
- [ ] All database queries use prepared statements
- [ ] No string concatenation in SQL queries
- [ ] User inputs are properly validated

### XSS Prevention
- [ ] All user-generated content is escaped with `htmlspecialchars()`
- [ ] No raw HTML output without sanitization
- [ ] Content Security Policy considered (if applicable)

### Authentication & Authorization
- [ ] Authentication checks on all protected pages
- [ ] Role-based access control implemented correctly
- [ ] Session security properly configured

### Input Validation
- [ ] All inputs validated on server-side
- [ ] Input types verified (email, int, string, etc.)
- [ ] Maximum length limits enforced
- [ ] Special characters handled appropriately

### CSRF Protection
- [ ] CSRF tokens on all state-changing forms
- [ ] Token validation implemented
- [ ] Tokens regenerated appropriately

### Password Security
- [ ] Passwords hashed with `password_hash()` (never plain text)
- [ ] No password in logs or error messages
- [ ] Password confirmation on sensitive operations

### Other Security Measures
- [ ] No sensitive data in error messages
- [ ] Proper error handling implemented
- [ ] No hardcoded credentials
- [ ] Environment variables used for secrets

## Database Changes

<!-- If you modified the database schema, fill this section -->

- [ ] No database changes in this PR
- [ ] Database changes included (describe below)

### Schema Changes

<!-- Describe any table/column additions, modifications, or deletions -->

```sql
-- Example:
-- ALTER TABLE users ADD COLUMN phone VARCHAR(20);
```

### Migration File

- [ ] Migration file created: `migrations/XXX_description.sql`
- [ ] Migration tested on development database
- [ ] Rollback plan documented

### Data Impact

- [ ] No existing data affected
- [ ] Existing data migration required (script included)
- [ ] Data backup recommended before applying

## Testing Completed

<!-- Mark all that apply -->

### Functionality Testing
- [ ] Tested on local development environment
- [ ] All new features work as expected
- [ ] Existing features still work (no regression)
- [ ] Edge cases tested

### Security Testing
- [ ] Tested SQL injection attempts
- [ ] Tested XSS attempts
- [ ] Tested CSRF protection
- [ ] Tested authentication/authorization
- [ ] Tested with invalid/malicious inputs

### Cross-Browser Testing (if UI changes)
- [ ] Chrome
- [ ] Firefox
- [ ] Safari
- [ ] Edge
- [ ] Mobile browsers

### Database Testing
- [ ] Queries execute correctly
- [ ] No N+1 query problems
- [ ] Proper indexes used
- [ ] Connection handling correct

## Code Quality Checklist

- [ ] Code follows project coding standards (PSR-12)
- [ ] Functions have clear, descriptive names
- [ ] Code is properly commented
- [ ] No commented-out code left in files
- [ ] No debug/console statements (var_dump, print_r, etc.)
- [ ] Error handling is appropriate
- [ ] Code is DRY (Don't Repeat Yourself)
- [ ] Functions are small and focused

## Documentation

- [ ] README.md updated (if needed)
- [ ] SECURITY.md updated (if security changes)
- [ ] Code comments added/updated
- [ ] Database schema documented (if changed)
- [ ] API documentation updated (if applicable)

## Files Changed

<!-- List the main files modified -->

- `file1.php` - Description of changes
- `file2.php` - Description of changes
- `file3.sql` - Description of changes

## Screenshots (if applicable)

<!-- Add screenshots for UI changes -->

### Before
<!-- Screenshot of old behavior/UI -->

### After
<!-- Screenshot of new behavior/UI -->

## Performance Impact

- [ ] No performance impact
- [ ] Performance improved
- [ ] Performance may be affected (explain below)

<!-- If performance is affected, explain why and what was done to mitigate -->



## Breaking Changes

<!-- If this is a breaking change, explain what breaks and how to migrate -->

- [ ] No breaking changes
- [ ] Breaking changes (describe below)



## Additional Notes

<!-- Any additional information that reviewers should know -->



## Pre-Submission Checklist

<!-- Final checks before submitting -->

- [ ] I have read the [CONTRIBUTING.md](CONTRIBUTING.md) guidelines
- [ ] I have read the [SECURITY.md](SECURITY.md) guidelines
- [ ] My code follows the project's code style
- [ ] I have performed a self-review of my own code
- [ ] I have commented my code where necessary
- [ ] I have tested all changes thoroughly
- [ ] I have checked for security vulnerabilities
- [ ] All new and existing tests pass
- [ ] No console errors or warnings
- [ ] No sensitive data (passwords, keys) in commits
- [ ] Branch is up to date with master
- [ ] Commit messages are clear and descriptive

## Reviewer Notes

<!-- Leave this section for reviewers -->

### Review Focus Areas

Please pay special attention to:
- 
- 
- 

---

**By submitting this pull request, I confirm that my contribution is made under the terms of the MIT License.**