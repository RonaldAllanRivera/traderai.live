fix: improve Turnstile widget implementation with explicit rendering

## Changes
- **Turnstile Widget**: Switch from automatic to explicit rendering to prevent initialization issues
- **Error Handling**: Add proper container cleanup and error logging to eliminate NaN console errors
- **Timing Control**: Implement conditional display that only renders widget when phone section is visible
- **State Management**: Add automatic widget reset on back button navigation for clean retry experience
- **Documentation**: Enhance README with comprehensive Bot Protection section and troubleshooting guide
- **UI**: Update submit button color from blue to green for better visual hierarchy

## Technical Details
- Removed automatic rendering attributes from Turnstile container
- Added explicit rendering with `render=explicit` parameter
- Implemented `renderTurnstile()` function with proper cleanup and error handling
- Created `showPhoneSection()` function to control UI transitions and widget timing
- Added 100ms delay to ensure container visibility before rendering
- Enhanced back button handling to clear rendered state and reset widget
- Updated CSP middleware documentation with Facebook domain usage explanation

## Bug Fixes
- Eliminated NaN console errors caused by multiple render attempts
- Fixed widget initialization timing issues
- Prevented conflicts from multiple widget instances
- Resolved iframe context console message confusion

## Files Changed
- resources/views/fxdtradingai-template/home.blade.php
- README.md
- CHANGELOG.md

## Testing
- Verified widget loads correctly when phone section becomes visible
- Confirmed back button properly resets widget state
- Tested form submission with successful Turnstile validation
- Validated console error reduction and improved error handling
