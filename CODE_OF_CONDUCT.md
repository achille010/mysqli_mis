# Code of Conduct

## Our Pledge

We as members, contributors, and maintainers pledge to make participation in mysqli_mis a harassment-free experience for everyone, regardless of age, body size, visible or invisible disability, ethnicity, sex characteristics, gender identity and expression, level of experience, education, socio-economic status, nationality, personal appearance, race, religion, or sexual identity and orientation.

We pledge to act and interact in ways that contribute to an open, welcoming, diverse, inclusive, and healthy community.

---

## Our Standards

### Positive Behavior

Examples of behavior that contributes to a positive environment:

- **Being Respectful**: Treating all contributors with respect and consideration
- **Being Collaborative**: Working together toward common goals
- **Being Constructive**: Providing helpful feedback and suggestions
- **Being Professional**: Maintaining professionalism in all interactions
- **Being Inclusive**: Welcoming diverse perspectives and experiences
- **Being Patient**: Understanding that people have different skill levels
- **Being Gracious**: Accepting constructive criticism positively
- **Focusing on Learning**: Helping others learn and grow

### Unacceptable Behavior

Examples of unacceptable behavior:

- **Harassment**: Any form of harassment or intimidation
- **Discrimination**: Discriminatory jokes, comments, or behavior
- **Trolling**: Deliberate disruption or inflammatory comments
- **Personal Attacks**: Insulting or derogatory comments
- **Public or Private Harassment**: Including unwelcome sexual attention
- **Publishing Private Information**: Sharing others' personal data without permission
- **Disrespectful Behavior**: Being condescending or dismissive
- **Spamming**: Repeated off-topic or promotional posts
- **Malicious Code**: Intentionally introducing vulnerabilities or malware
- **Other Conduct**: Any conduct inappropriate in a professional setting

---

## Project-Specific Standards

### Code Contributions

- **Write Secure Code**: Follow security best practices always
- **Respect Code Standards**: Follow project coding conventions
- **Document Your Work**: Add clear comments and documentation
- **Test Thoroughly**: Ensure your code works as expected
- **Be Honest**: If you're unsure, ask for help

### Code Reviews

#### As a Reviewer

- **Be Constructive**: Focus on the code, not the person
- **Be Specific**: Point to exact lines and explain why
- **Be Kind**: Remember someone put time and effort into this
- **Be Educational**: Explain concepts to help others learn
- **Be Timely**: Review pull requests in a reasonable timeframe
- **Be Thorough**: Check for security issues and best practices

#### As a Contributor

- **Be Receptive**: Accept feedback gracefully
- **Be Responsive**: Address review comments promptly
- **Be Patient**: Reviews take time
- **Be Collaborative**: Work with reviewers to improve code
- **Be Understanding**: Reviewers are volunteers too

### Discussions and Issues

- **Be Clear**: Provide detailed information in bug reports
- **Be Respectful**: Disagreements are okay, disrespect is not
- **Be Patient**: Maintainers may take time to respond
- **Stay On Topic**: Keep discussions relevant
- **Search First**: Check if your issue/question already exists

---

## Security and Privacy

### Responsible Disclosure

- **Report Vulnerabilities Privately**: Never publicly disclose security issues
- **Follow Security Policy**: See [SECURITY.md](SECURITY.md) for reporting
- **Be Responsible**: Don't exploit vulnerabilities
- **Be Patient**: Allow time for fixes before public disclosure

### Privacy

- **Protect User Data**: Never share or expose user information
- **Respect Confidentiality**: Keep private repository content private
- **Handle Credentials Carefully**: Never commit API keys or passwords
- **Follow Data Protection Laws**: Comply with GDPR, CCPA, etc.

---

## Enforcement Responsibilities

Project maintainers are responsible for clarifying and enforcing our standards of acceptable behavior and will take appropriate and fair corrective action in response to any behavior that they deem inappropriate, threatening, offensive, or harmful.

Project maintainers have the right and responsibility to remove, edit, or reject comments, commits, code, wiki edits, issues, and other contributions that do not align with this Code of Conduct, and will communicate reasons for moderation decisions when appropriate.

---

## Scope

This Code of Conduct applies within all project spaces, including:

- GitHub repository (code, issues, pull requests, discussions)
- Communication channels (email, chat, forums)
- Project events (meetups, conferences, presentations)
- Social media when representing the project

This Code of Conduct also applies when an individual is officially representing the project in public spaces.

---

## Enforcement

### Reporting

Instances of abusive, harassing, or otherwise unacceptable behavior may be reported to the project maintainers responsible for enforcement:

- **GitHub**: Open a private report or contact maintainers directly
- **Email**: [Your contact email]
- **Method**: Provide detailed description of the incident

All complaints will be reviewed and investigated promptly and fairly.

### Confidentiality

All community leaders are obligated to respect the privacy and security of the reporter of any incident.

---

## Enforcement Guidelines

Project maintainers will follow these Community Impact Guidelines in determining the consequences for any action they deem in violation of this Code of Conduct:

### 1. Correction

**Community Impact**: Use of inappropriate language or other behavior deemed unprofessional or unwelcome.

**Consequence**: A private, written warning from project maintainers, providing clarity around the nature of the violation and an explanation of why the behavior was inappropriate. A public apology may be requested.

### 2. Warning

**Community Impact**: A violation through a single incident or series of actions.

**Consequence**: A warning with consequences for continued behavior. No interaction with the people involved, including unsolicited interaction with those enforcing the Code of Conduct, for a specified period of time. This includes avoiding interactions in project spaces as well as external channels like social media. Violating these terms may lead to a temporary or permanent ban.

### 3. Temporary Ban

**Community Impact**: A serious violation of community standards, including sustained inappropriate behavior.

**Consequence**: A temporary ban from any sort of interaction or public communication with the project for a specified period of time. No public or private interaction with the people involved, including unsolicited interaction with those enforcing the Code of Conduct, is allowed during this period. Violating these terms may lead to a permanent ban.

### 4. Permanent Ban

**Community Impact**: Demonstrating a pattern of violation of community standards, including sustained inappropriate behavior, harassment of an individual, or aggression toward or disparagement of classes of individuals.

**Consequence**: A permanent ban from any sort of public interaction within the project.

---

## Security-Related Conduct

### Additional Rules for Security Work

When working with security-sensitive code:

- **Never Exploit Vulnerabilities**: Don't use discovered vulnerabilities maliciously
- **Report Responsibly**: Follow responsible disclosure practices
- **Protect Test Data**: Don't use real user data for testing
- **Be Careful with Examples**: Don't provide exploitable examples
- **Consider Impact**: Think about security implications of your contributions

### Violations

Severe security-related misconduct may result in:

- Immediate permanent ban
- Report to appropriate authorities if laws were broken
- Legal action if damage was caused

---

## Examples of Good Conduct

### Positive Interactions

**Good Code Review Comment:**
```
This is a good start! However, this query is vulnerable to SQL injection. 
Consider using a prepared statement like this:

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);

This will protect against SQL injection attacks. Let me know if you need 
help implementing this!
```

**Good Issue Report:**
```
**Bug Report: Login fails with special characters in password**

Steps to reproduce:
1. Register with password containing special chars (e.g., p@ss!word)
2. Try to login
3. Login fails even with correct password

Expected: Login should work
Actual: Login fails

Environment:
- PHP 7.4
- MySQL 8.0
- Chrome 120

I suspect the issue might be in login.php around line 25 where the 
password comparison happens.
```

### Negative Interactions to Avoid

**Bad Code Review Comment:**
```
This code is terrible. Did you even try? Use prepared statements!
```

**Bad Issue Report:**
```
Login doesn't work. Fix it.
```

---

## Learning and Growth

### Mistakes Happen

- **Everyone Makes Mistakes**: We all have learning curves
- **Ask for Help**: It's okay to not know everything
- **Learn from Feedback**: Use reviews as learning opportunities
- **Improve Together**: Help others learn from their mistakes

### Resources for Learning

- PHP Security best practices
- OWASP Top 10
- MySQL documentation
- Project README and CONTRIBUTING guides

---

## Questions About the Code of Conduct

If you have questions about this Code of Conduct:

1. Open an issue with the "question" label
2. Contact maintainers directly
3. Check our FAQ (if available)

---

## Attribution

This Code of Conduct is adapted from:

- [Contributor Covenant](https://www.contributor-covenant.org/), version 2.1
- [OWASP Code of Conduct](https://owasp.org/www-policy/operational/code-of-conduct)
- Community best practices for open source projects

---

## Updates

This Code of Conduct may be updated as the project grows. Contributors will be notified of significant changes.

**Version**: 1.0  
**Last Updated**: March 2026  
**Effective Date**: March 2026

---

## Acknowledgment

By participating in this project, you agree to abide by this Code of Conduct.

Thank you for helping make mysqli_mis a welcoming and productive community!

---

**Contact**: achille010  
**Email**: [Your email]  
**GitHub**: https://github.com/achille010/mysqli_mis