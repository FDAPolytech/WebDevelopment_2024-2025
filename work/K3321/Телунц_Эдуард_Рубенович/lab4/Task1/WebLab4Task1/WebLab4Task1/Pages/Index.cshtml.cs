using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;

namespace WebLab4Task1.Pages
{
    [IgnoreAntiforgeryToken]
    public class IndexModel : PageModel
    {
        ApplicationContext context;
        [BindProperty]
        public User Person { get; set; } = new();
        public IndexModel(ApplicationContext db)
        {
            context = db;
        }
        public async Task<IActionResult> OnPostAsync()
        {
            context.Users.Add(Person);
            await context.SaveChangesAsync();
            return RedirectToPage("Index");
        }
    }
}
