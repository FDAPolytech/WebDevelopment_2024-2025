using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using WebLab3Task2.Models;

namespace WebLab3Task2.Pages
{
    [IgnoreAntiforgeryToken]
    public class IndexModel : PageModel
    {
        [BindProperty]
        public UserProfile UserProfile { get; set; }

        public void OnGet()
        {
            if (UserProfile == null)
            {
                UserProfile = new UserProfile();
            }


        }

        public IActionResult OnPost()
        {
            return Page();
        }
    }
}
